<?php
/* USERS.FUNCTIONS */
/*****************************************************************/

/** 
  * @desc	create record
  * @param	
  * @return none - redirect will occure accordingly
*/
	function create_Users()
	{	  
		$createdAt = date('Y-m-d H:i:s');
		$valid_until = date("H:i",time() + 1800); // +30 minutes from when created
		$authcode = random_string_Helpers($length=25);
		
		if(!validate_Email($_POST['email']))
		{
			header( 'Location: view.php?return=email_invalid' ) ;
			exit;
		}
		
		$num_rows = read_Users(FALSE,$_POST['email']);	
		
		if($_SESSION['NUM_ROWS']($num_rows) == "1")
		{
			header( 'Location: view.php?return=email_duplicate' ) ;	  
			exit;
			  
		}else{
		  	  
		  //$string = random_string_Helpers();
		  $string = 'mypassword';
		  
		  if(!isset($_POST['role_id']))
		  {
			  $_POST['role_id'] = '2'; // Defined as "User"
		  }
		  
		  // use  password_hash() and password_verify() to encrypt password
		  $hash = password_hash($string, PASSWORD_DEFAULT);

		  $sql = "INSERT INTO system_tbl_users
				  (email, name_first, name_last, password, role_id, createdAt) 
				  VALUES ('$_POST[email]', '$_POST[name_first]', '$_POST[name_last]', '$hash', '$_POST[role_id]','$createdAt') " ;
		  
		  $result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
		  
		  $userid = mysqli_insert_id($_SESSION['connection']);
		  
		  $sql2 = "INSERT INTO system_tbl_set_password
				  (email, authcode, valid_until) 
				  VALUES ('$_POST[email]', '$authcode', '$valid_until') " ;
		  
		  $result2 = $_SESSION['QUERY']($_SESSION['connection'],$sql2);
		  
		  registration_info_Email($userid);
		  //header( 'Location: /index.php' ) ;		
		}
	}
/*****************************************************************/

/** 
  * @desc	read data from table
  * @param	$id
  * @return complete query structure
*/
	function read_Users($id=FALSE,$email=FALSE)
	{
	  $sql = 'SELECT id, email, name_first, name_last, password, role_id FROM system_tbl_users WHERE 0=0 ';	
	  if($id !== FALSE)
	  {
		$sql.= ' AND id = "'.$id.'" ';	  
	  }  
	  if($email !== FALSE)
	  {
		$sql.= ' AND email = "'.$email.'" ';	  
	  }
	  $sql.= ' ORDER BY name_last, name_first ';
	  
	  $result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
	  
	  return $result;
	}
/*****************************************************************/

/** 
  * @desc	read specific value
  * @param	$id
  * @return specific name
*/
	function read_values_Users($id=FALSE)
	{
	  $sql = 'SELECT id, email, name_first, name_last, password, role_id FROM system_tbl_users ';	
	  if($id !== FALSE)
	  {
		$sql.= ' WHERE id = "'.$id.'" ';	  
	  }  
	  
	  $result = $_SESSION['QUERY']($_SESSION['connection'],$sql or die (mysqli_error()));
	  
	  while($data = mysqli_fetch_array($result))
	  {
		  $id = $data['id'];
		  $email = $data['email'];
		  $name_first = $data['name_first'];
		  $name_last = $data['name_last'];
		  $password = $data['password'];
		  $role_id = $data['role_id'];
	  }
	  
	  return array('id' => $id, 'email' => $email, 'name_first' => $name_first, 'name_last' => $name_last,
	  			   'password' => $$password, 'role_id' => $role_id);
	}
/*****************************************************************/

/** 	
  * @desc	update
  * @param	$id (specific record)
  * @return none
*/
	function update_Users()
	{
	  $email = encrypt_Security($_POST['email'],ENCRYPTION_KEY);
	  $password = encrypt_Security($_POST['password'],ENCRYPTION_KEY);
	  
	  $sql = "UPDATE system_tbl_users
			  SET ";
	  
	  if(isset($_POST['change_password']))
	  {
		$sql.= "login_attempts = '1' , ";  
	  }
	  
	  $sql.= " 
			  email = '".$email."' ,
			  name_first = '".addslashes($_POST['name_first'])."' ,
			  name_last = '".addslashes($_POST['name_last'])."' ,
			  password = '".addslashes($password)."' ,
			  role_id = '".$_POST['role_id']."'
			  WHERE id = '".$_POST['id']."'
			 ";
			 
	  $result = $_SESSION['QUERY']($_SESSION['connection'],$sql or die (mysqli_error()));
	  
	  if(isset($_POST['change_password']))
	  {
		clear_variables_Login();  
	  }else{
	  	header( 'Location: view.php' ) ;
	  }
	}
/*****************************************************************/

/** 
  * @desc	delete
  * @param	$id
  * @return none
*/
	function delete_Users($id="")
	{
	  if($id != "")
	  {
		$sql = 'DELETE FROM system_tbl_users
				WHERE id = "'.$id.'" ';
					  
		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql or die (mysqli_error()));
		
		header( 'Location: view_register_success.php' ) ;
	  }
	}
/*****************************************************************/

/** 
  * @desc	create an html select list
  * @param	$id(selected record) - $value(class, id, etc)
  * @return none - echo out list
*/
	function html_list_Users($id=FALSE,$values=FALSE)
	{
	  $sql = " SELECT *FROM system_tbl_users WHERE ";	
	  $sql.= ' ORDER BY name_last, name_first';
	  
	  $result = $_SESSION['QUERY']($_SESSION['connection'],$sql or die (mysqli_error()));
	  
	  echo '<select name="user_id" "'.$values.'">';
	  while($row = mysqli_fetch_array($result))
	  {
		if($row['id'] == $id){ $selected="selected"; }else{ $selected=""; }
		echo '<option value="'.$row['id'].'" '.$selected.'>'.$row['name_first'].' '.$row['name_last'].'</option>';  
	  }
	  echo '</select>';
	}
/*****************************************************************/
	
?>