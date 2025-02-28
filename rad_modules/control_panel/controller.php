<?php
/* CONTROL_PANEL.CONTROLLER */
/*****************************************************************/

/**
  * @desc	start the create process
  * @param	$_POST
  * @return none
*/
	if(isset($_POST['create']))
	{
	  create_Control_Panel();
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
	  update_Control_Panel();	  
	}
/*****************************************************************/

/**
  * @desc	start the delete process
  * @param	$_POST
  * @return none - redirect is done within the function
*/
	if(isset($_POST['delete']))
	{
	  delete_Control_Panel($_POST['id']);	  
	}
/*****************************************************************/

/**
  * @desc	read values and create queries based on them
  * @param	
  * @return 
*/
	//$records_all = read_Control_Panel();
/*****************************************************************/

?>