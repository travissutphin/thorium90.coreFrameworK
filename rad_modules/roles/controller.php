<?php
/* 	REMINDERS.CONTROLLER */
/*****************************************************************/

/** 
  * @desc	create record
  * @param	$_POST
  * @return - redirect done in function
*/
	if(isset($_POST['create']))
	{
	  create_Roles();
	  header( 'Location: view.php' ) ;
	}
/*****************************************************************/

/** 
  * @desc	update record
  * @param	$_POST
  * @return none - redirect done in function
*/
	if(isset($_POST['update']))
	{
	  update_Roles();
	  header( 'Location: view.php' ) ;
	}
/*****************************************************************/

/** 
  * @desc	delete record
  * @param	$_POST
  * @return - redirect done in function
*/
	if(isset($_POST['delete']))
	{
	  delete_Roles($_POST['id']);
	  header( 'Location: view.php' ) ;
	}
/*****************************************************************/

/** 
  * @desc	read record
  * @param	
  * @return 
*/
	$records_all = read_Roles();
	
	if(isset($_POST['id']))
	{
	  $records_by_id= read_Roles($_POST['id']);
	}
/*****************************************************************/

?>