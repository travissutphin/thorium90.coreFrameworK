<?php
/* _SYSTEM.HELPER */
/*****************************************************************/

	// LIST OF FUNCTIONS CONTAINED//
	////////////////////////////////
	
	//active_status_Helpers()
	// yes_no_Helpers()
	// set_postVars_to_sessionVars_Helpers()
	// clear_postVars_to_sessionVars_Helpers()
	// error_report_Helpers() - clear detailed error report
	// last_inserted_id_Helpers() - get id of last record inserted
	// randon_string_Helpers() - created random string of x chars
	// upload_Helpers() - upload file to temp location
	// detect_device_Helpers() - detects type of device that is connected

/*****************************************************************/



/**
  * @desc	display 1 as Active and 0 as Not Active
  * @param	$value
  * @return none
*/
	function active_status_Helpers($value)
	{
		if($value == "1")
		{
			$return = "Active";
		}
		elseif($value == "0")
		{
			$return = "Not Active";	
		}

		return $return;
	}
/*****************************************************************/	


/**
  * @desc	display 1 as Yes and 0 as No
  * @param	$value
  * @return none
*/
	function yes_no_Helpers($value)
	{
		if($value == "1")
		{
			$return = "Yes";
		}
		elseif($value == "0")
		{
			$return = "No";	
		}

		return $return;
	}
/*****************************************************************/	


/**
  * @desc	create alias
  * @param	$_POST
  * @return none
*/
	function create_alias_Helpers($value)
	{
		$value = trim($value);
		$value = addslashes($value);
		$value = htmlspecialchars($value, ENT_QUOTES);
		$value = htmlentities($value, ENT_QUOTES);
		$value = preg_replace('/\s+/', '-', $value);
		
		return $value;
	}
/*****************************************************************/	



/**
  * @desc	display value 
  * @param	
  * @return none
*/
	function event_status_Helpers($value=FALSE)
	{
		if($value == '1'){ $result="Offline"; }
		if($value == '2'){ $result="RegOnly"; }
		if($value == '3'){ $result="Active"; }
		if($value == '4'){ $result="Archived"; }
		
		return $result;
	}
/*****************************************************************/


/**
  * @desc	save posted vars to session vars
  * @param	$_POST
  * @return none
*/
	function set_postVars_to_sessionVars_Helpers()
	{
		foreach ($_POST as $key => $value) 
		{
			// x_ = add to posted vars you don't want included here that are not listed in $_SESSION['ignore']
			if(!in_array($key,$_SESSION['ignore']) and strpos($key, 'x_') === FALSE) // $_SESSION['ignore'] = _system/config.php
			{
		  		$_SESSION[$key] = $value;		  
			}
		}
		$message = 'vars_saved';
		return $message;
	}
/*****************************************************************/	


/**
  * @desc	clear session vars based on posted vars
  * @param	$_POST
  * @return none
*/
	function clear_postVars_to_sessionVars_Helpers()
	{
		foreach ($_POST as $key => $value) 
		{
	  		$_SESSION[$key] = '';		    
		}
		
		$message = 'vars_cleared';
		return $message;
	}
/*****************************************************************/	

			
/**
  * @desc	clear error report
  * @param	$message_for_admin
  * @return none
*/
	function error_report_Helpers($message_for_admin,$sql)
	{
		$_SESSION['error'] = $_SESSION['QUERY_ERROR']($_SESSION['connection']);
		$_SESSION['error_sql'] = $sql; 
		$_SESSION['error_message_for_admin'] = $message_for_admin;
		$_SESSION['error_post_vars'] = $_POST; 
		$_SESSION['error_get_vars'] = $_GET; 
		$_SESSION['error_session_vars'] = $_SESSION; 
		header( 'Location: '.app_Url().'templates/error.php' ); 
		exit; 
	}
/*****************************************************************/	

		
/**
  * @desc	gets last inserted ID 
  * @param	$result
  * @return $id
*/
	function last_inserted_id_Helpers($result=FALSE) 
	{
        if(DB_TYPE == "MYSQL")
		{
			return mysqli_insert_id($_SESSION['connection']);
		}
		elseif(DB_TYPE == "MSSQL")
		{
			sqlsrv_next_result($result);
        	sqlsrv_fetch($result);
    		return sqlsrv_get_field($result, 0);
		}
    } 
/*****************************************************************/	
	
	
/**
  * @desc	creates random string 
  * @param	$length
  * @return $string
*/
	function random_string_Helpers($length=FALSE) 
	{
	  if($length == FALSE){ $length = 5; }
	  
	  $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
	  $string = '';
	   
	  for ($p = 1; $p <= $length; $p++)
	  {
	  	$string .= $characters[mt_rand(0, strlen($characters))];
	  }
	  
	  return $string;
	}
/*****************************************************************/


/**
  * @desc	upload a file 
  * @param	$_FILES
  * @return none
*/
	function upload_Helpers() 
	{
	  if ($_FILES["file"]["error"] > 0)
	  {
		  echo "Error: " . $_FILES["file"]["error"] . "<br>";
	  }
	  else
	  {
		  echo "Upload: " . $_FILES["file"]["name"] . "<br>";
		  echo "Type: " . $_FILES["file"]["type"] . "<br>";
		  echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
		  echo "Stored in: " . $_FILES["file"]["tmp_name"];
	  }
	}
/*****************************************************************/


/**
  * @desc	detect if device being used should show the mobile version 
  * @param	
  * @return none - redirects if necessary
*/
	function detect_device_Helpers()
	{
		$ismobile = 0;
		$container = $_SERVER['HTTP_USER_AGENT'];
		
		// A list of mobile devices 
		$useragents = array ( 
		'iPhone', 'iPod', 'Blazer' , 'Palm' , 'Handspring' , 'Nokia' , 'Kyocera', 'Samsung', 'Motorola' , 'Smartphone', 'Windows CE', 'Blackberry',
		'WAP', 'SonyEricsson', 'PlayStation Portable', 'LG', 'MMP', 'OPWV',	'Symbian', 'EPOC', ); 
		
		foreach ( $useragents as $useragents ) 
		{ 
			if(strstr($container,$useragents)) 
			{
				$ismobile = 1;
			} 
		}
	
		if ( $ismobile == 1 ) 
		{
			//header( 'Location: '.site_url().'m/' ) ;
		}
	}
/*****************************************************************/

/**
  * @desc	create alias
  * @param	$_POST
  * @return none
*/
	function seo_Helpers()
	{
		if($_SESSION['subdomain'] == 'tfk'){
			
			$_SESSION['meta_title'] = 'The Free Kraken Network';
			
		}elseif($_SESSION['subdomain'] == 'hbd'){
			
			$_SESSION['meta_title'] = 'Home-Based Business Directory';
			
		}elseif($_SESSION['subdomain'] == 'mjj'){
			
			$_SESSION['meta_title'] = 'My Jeep Junk';
			
		}elseif($_SESSION['subdomain'] == 'hfr'){
			
			$_SESSION['meta_title'] = 'Homes for Rent';
			
		}elseif($_SESSION['subdomain'] == 'tgm'){
			
			$_SESSION['meta_title'] = 'Third Grade Math';
			
		}elseif($_SESSION['subdomain'] == 'tpx'){
			
			$_SESSION['meta_title'] = 'The Puzzle Exchange';
			
		}
		
	}
/*****************************************************************/	



?>