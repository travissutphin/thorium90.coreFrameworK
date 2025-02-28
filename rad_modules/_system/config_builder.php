<?php
/* _SYSTEM.CONFIG */
/*****************************************************************/
	
	session_start();

/**
  * @desc	
  * @param	
  * @return 
*/
	define("DB_SERVER","DB_SERVER_VALUE");
	define("DB_DATABASE","DB_DATABASE_VALUE");
	define("DB_USER","DB_USER_VALUE");
	define("DB_PASSWORD", "DB_PASSWORD_VALUE");
	define("APP_DIRECTORY", "APP_DIRECTORY_VALUE"); // should be "/" if app is on the root
/*****************************************************************/	
	
/**
  * @desc	ran first to ensure site_Url and root_Url are defined
  * @param	
  * @return 
*/
	include_once('url.php');

/*****************************************************************/
  
/**
  * @desc	system modules
  * @param	
  * @return 
*/
	include_once($_SERVER['DOCUMENT_ROOT']."".APP_DIRECTORY."modules/_system/security.php");
	//is_logged_in_Security();  // verify we are logged in before loading any thing else
	include_once($_SERVER['DOCUMENT_ROOT']."".APP_DIRECTORY."modules/_system/database.php");
	include_once($_SERVER['DOCUMENT_ROOT']."".APP_DIRECTORY."modules/_system/dates_times.php");
	include_once($_SERVER['DOCUMENT_ROOT']."".APP_DIRECTORY."modules/_system/email.php");
	include_once($_SERVER['DOCUMENT_ROOT']."".APP_DIRECTORY."modules/_system/message_center.php");
	include_once($_SERVER['DOCUMENT_ROOT']."".APP_DIRECTORY."modules/_system/helper.php");


	
/*****************************************************************/
  
/**
  * @desc	core modules required for app to function
  * @param	
  * @return 
*/
	include_once($_SERVER['DOCUMENT_ROOT']."".APP_DIRECTORY."modules/users/functions.php");
	include_once($_SERVER['DOCUMENT_ROOT']."".APP_DIRECTORY."modules/roles/functions.php");
	include_once($_SERVER['DOCUMENT_ROOT']."".APP_DIRECTORY."modules/login/functions.php");
	include_once($_SERVER['DOCUMENT_ROOT']."".APP_DIRECTORY."modules/register/functions.php");
/*****************************************************************/
  
/**
  * @desc	addon modules for updates to the app
  * @param	
  * @return 
*/
 
 
/*****************************************************************/

/**
  * @desc	this should only be changed following installation.
  * 		modifying this in ayway once data has been added will 
  *			render all encrypted values unreadable
  * @param	
  * @return 
*/

	define("ENCRYPTION_KEY", "ENCRYPTION_KEY_VALUE");

?>