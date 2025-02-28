<?php
/* USERS.CONTROLLER */
/*****************************************************************/

/**
  * @desc	start the create process
  * @param	$_POST
  * @return none - redirect is done within the function
*/
	if(isset($_POST['create']))
	{
	  create_Users();
	  header( 'Location: view.php' ) ;
	}
/*****************************************************************/

/**
  * @desc	start the update process
  * @param	$_POST
  * @return none - redirect is done within the function
*/
	if(isset($_POST['update']))
	{
	  update_Users();
	  header( 'Location: view.php' ) ;
	}
/*****************************************************************/

/**
  * @desc	start the delete process
  * @param	$_POST
  * @return none - redirect is done within the function
*/
	if(isset($_POST['delete']))
	{
	  delete_Users($_POST['id']);
	  header( 'Location: view.php' ) ;
	}
/*****************************************************************/

/**
  * @desc	read values and create queries based on them
  * @param	
  * @return 
*/
	$records_all = read_Users();
	$records_all_num_rows = mysqli_num_rows($records_all);
	if(isset($_POST['id']))
	{
	  $records_by_id= read_Users($_POST['id']);
	}

?>