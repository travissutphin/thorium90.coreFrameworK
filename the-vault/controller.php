<?php
/* THE-VAULT.ROOT.CONTROLLER */
/*****************************************************************/
include('../modules/_system/config.php');

$message = isset($_SESSION['message']) ? $_SESSION['message'] : false;

/**
  * @desc   Specifies and enforces access control for a page based on user role or permissions.
  * @param  none
  * @return void
  * @edited 2024-11
*/

// Check if the login form was submitted via POST
if (!empty($_POST)) 
{
    // Call the function to verify login credentials
    if (validate_Login($_POST["email"], $_POST["password_hash"])) {
       
    } else {

		// Set error message and redirect back to login if authentication fails
        $_SESSION['message'] = 'Invalid email or password.';
        header('Location: login.php');
        exit;
    }
} else {	
    // If form was not submitted via POST, redirect to login page
    header('Location: login.php');
    exit;
}
/*****************************************************************/



/**
  * @desc   if url passed and url = action 
  * @param  none
  * @return void
  * @edited 2024-11
*/
if(isset($_REQUEST['action']))
{
	
	if($_REQUEST['action'] == "logout")
	{
		logout_user('logout');
	}
}
/*****************************************************************/