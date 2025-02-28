<?php
/* LOGIN.CONTROLLER */
/*****************************************************************/

/** 
  * @desc	start login process 
  * @param	$_POST vars
  * @return non - redirect occurs within the function
*/
	if(isset($_POST['submit']))
	{
		validate_Login(); 
	}
/*****************************************************************/


/** 
  * @desc	start registration process
  * @param	$_POST vars
  * @return non - redirect occurs within the function
*/
	if(isset($_POST['register']))
	{
		create_Users(); 	  
	}
/*****************************************************************/


/* forgot password
 *
 *
 */
	if(isset($_POST['forgot_password']))
	{
		echo '';
		//forgot_password_email($id);
	}
/*****************************************************************/

?>