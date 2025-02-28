<?php
/* USERS.CONTROLLER */
/*****************************************************************/


//has_access_to_page_Security($permission=1);

$message = isset($_REQUEST['message']) ? $_REQUEST['message'] : false;

/**
  * @desc	start the create process
  * @param	$_POST
  * @return none
*/
	if(isset($_POST['create']))
	{
	  $message = create_Users();
	}
/*****************************************************************/

/**
  * @desc	start the update process
  * @param	$_POST
  * @return none - redirect is done within the function
*/
	if(isset($_POST['update']))
	{
	  $message = update_Users();
	  header('Location: view.php?message='.$message);
	  exit;
	}
/*****************************************************************/


/**
  * @desc	start the delete process
  * @param	$_POST
  * @return none - redirect is done within the function
*/
	if(isset($_POST['delete']))
	{
	  $message = delete_Users($_POST['USER_ID']);	
	  header( 'Location: view.php?message='.$message ) ;  
	}
/*****************************************************************/



/**
  * @desc	read values and create queries based on them
  * @param	
  * @return 
*/
	
	$read_users = read_Users(); // view the admin list		

/*****************************************************************/
	

?>