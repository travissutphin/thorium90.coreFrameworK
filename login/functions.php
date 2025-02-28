<?php
/* LOGIN.FUNCTIONS */
/*****************************************************************/

/** 
  * @desc	attempt to log the user in and redirect appropriately
  * @param	$_POST['email'] - $_POST['password']
  * @return none
*/
function validate_Login()
	{		
	  //$email = encrypt_Security($_POST['email'],ENCRYPTION_KEY);
	  //$password = encrypt_Security($_POST['password'],ENCRYPTION_KEY);
	  $email = $_POST['email'];
	  $password = $_POST['password'];
	  
	  $sql = 'SELECT id, email, name_first, name_last, password, role_id, createdAt FROM system_tbl_users ';	
	  $sql.= ' WHERE email = "'.stripslashes($email).'" ';	
	  //$sql.= '   AND password = "'.stripslashes($password).'" ';  

	  $result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
	
	  $num_rows = $_SESSION['NUM_ROWS']($result);
	
	  if($num_rows == 1) // login credentials are correct 
	  {
		while ($row = mysqli_fetch_array($result))
		{
		  if(password_verify($password, $row['password']))
		  {
			set_variables_Login($row['id']); // save session vars for this user
		  }
		}
		
		header( 'Location: account/');
		exit;
  
	  }else{
		$_SESSION['message'] = 'user_not_found';
		header( 'Location: account`	/' ) ;
		exit;
	  }
		
	  return $result;
	}
/*****************************************************************/

/** 
  * @desc
  * @param
  * @return
*/
	function set_variables_Login($id)
	{
	  $sql = 'SELECT id, email, name_first, name_last, password, role_id, createdAt FROM system_tbl_users ';	
	  $sql.= ' WHERE id = "'.$id.'" ';	
	  
	  $result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
	  
	  while ($row = $_SESSION['FETCH_ARRAY']($result))
	  {
		 $_SESSION['users.id'] = $row['id'] ;
		 $_SESSION['users.email'] = $row['email'] ;
		 $_SESSION['users.name_first'] = $row['name_first'] ;
		 $_SESSION['users.name_last'] = $row['name_last'] ;
		 $_SESSION['users.role_id'] = $row['role_id'] ;
		 $_SESSION['users.createdAt'] = $row['createdAt'] ;
		 //$_SESSION['users.login_attempts'] = $row['login_attempts'] ;
		 
		 header( 'Location: '.app_Url().'login/' ) ;
	  }
		
	}
/*****************************************************************/

/** 
  * @desc
  * @param
  * @return
*/
	function clear_variables_Login()
	{
	   $_SESSION['message'] = 'logout';
	   unset($_SESSION['users.id']) ;
	   unset($_SESSION['users.email']) ;
	   unset($_SESSION['users.name_first']) ;
	   unset($_SESSION['users.name_last']) ;
	   unset($_SESSION['users.role_id']) ;
	   unset($_SESSION['users.createdAt']) ;
	   unset($_SESSION['users.login_attempts']) ;
		
	  header( 'Location: '.app_Url().'login/' ) ; 	
	  exit;
	}
/*****************************************************************/

/** 
  * @desc
  * @param
  * @return
*/
	function validate_variables_Login()
	{
		if(!isset($_SESSION['users.role_id']))
		{
		  $_SESSION['message'] = "timed_out";
		  header( 'Location: '.site_Url() ) ;
		  exit;
		}
	}
/*****************************************************************/

?>