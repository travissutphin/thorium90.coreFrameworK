<?php
/* _SYSTEM.CONFIG */
/*****************************************************************/


/**
  * @desc	Security check: Prevent direct access to this file	
  *			Ensures the file is included through the application and not accessed directly via a URL.
  * @param	
  * @return 
*/
	
/*****************************************************************/	


	
/**
  * @desc	if session not started already, start it	
  * @param	
  * @return 
*/
	if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
/*****************************************************************/	



/**
  * @desc	ran first to ensure site_Url and root_Url are defined
  * @param	
  * @return 
*/
	include_once('url.php');
/*****************************************************************/



/**
  * @desc	globally defined variables	
  * @param	
  * @return 
*/
	date_default_timezone_set("US/Eastern");
	setlocale(LC_MONETARY,"en_US");
	define("DB_TYPE","MYSQL");// MYSQL or MSSQL
	
	$value = site_Url();
	if (str_contains($value, "127.0.0.1") or str_contains($value, "localhost")) {	
		// define values for local server
		define("DB_SERVER","localhost"); 
		define("DB_DATABASE","thorium90.app");
		define("DB_USER","root");
		define("DB_PASSWORD", "");
		define("APP_DIRECTORY", "/thorium90.app/"); // should be "/" if app is on the root or "/dir/" if in a directory
		define("APP_URL", "/thorium90.app/"); // should be "/" if app is on the root
	}else{
		// define values for production server
		define("DB_SERVER","45.55.69.219"); 
		define("DB_DATABASE","dpzvmdnsmy");
		define("DB_USER","dpzvmdnsmy");
		define("DB_PASSWORD", "xbCES7mxB5");
		define("APP_DIRECTORY", "/"); // should be "/" if app is on the root
		define("APP_URL", "/"); // should be "/" if app is on the root
	}
	define("DEFAULT_TITLE","Thorium90.app");
	define("DEFAULT_AUTHOR","Thorium90");
	define("DEFAULT_REPLYTO","");
	define("SESSION_LIFETIME", 3600); // 1 hour (3600 seconds) - User logged out after 1 hour - no reset
	define("INACTIVITY_TIMEOUT", 900); // 15 minutes (900 seconds)
	
	// images defined
	//blog image - primary image
	define("BLOG_IMAGE_LENGTH") = '800';
	define("BLOG_IMAGE_WIDTH") = '600';
	define("BLOG_IMAGE_CROP") = FALSE;
	
	//ipinfo.io API key to detect IP address//
	define("IPINFO_API_KEY","eaccd228b3739e");
	
	//facebook hbb login//
	define("FB_APP_ID","");
	define("FB_APP_SECRET","");
	define("FB_API_VERSION","");
	define("FB_BASE_URL","");
	
	//google	
	define("GTM",""); // google tag manager 
	define("GA_MEASUREMENT_ID",""); // google tag
	
	//dark / light mode
	define("DARK_LIGHT_MODE","bg-dark text-light"); //Dark=bg-dark text-light | Light=bg-light text-dark
	define("DARK_LIGHT_MODE_NAV_FOOTER","navbar-dark bg-dark text-light");//Dark=navbar-dard bg-dark | Light=navbar-light bg-light
	define("DARK_LIGHT_MODE_TEXT","text-light");//Dark=text-dark | Light=text-light
/*****************************************************************/	
	

 
/**
  * @desc	system modules
  * @param	
  * @return 
*/
	include_once($_SERVER['DOCUMENT_ROOT']."".APP_DIRECTORY."rad_modules/_system/security.php");
	include_once($_SERVER['DOCUMENT_ROOT']."".APP_DIRECTORY."rad_modules/_system/database.php");
	include_once($_SERVER['DOCUMENT_ROOT']."".APP_DIRECTORY."rad_modules/_system/dates_times.php");
	include_once($_SERVER['DOCUMENT_ROOT']."".APP_DIRECTORY."rad_modules/_system/email.php");
	include_once($_SERVER['DOCUMENT_ROOT']."".APP_DIRECTORY."rad_modules/_system/message_center.php");
	include_once($_SERVER['DOCUMENT_ROOT']."".APP_DIRECTORY."rad_modules/_system/helpers.php");
	include_once($_SERVER['DOCUMENT_ROOT']."".APP_DIRECTORY."rad_modules/_system/error_handler.php");	
/*****************************************************************/

/**
  * @desc	addon modules
  * @param	
  * @return 
*/
	include_once($_SERVER['DOCUMENT_ROOT']."".APP_DIRECTORY."rad_modules/_ip_log/functions.php");
	include_once($_SERVER['DOCUMENT_ROOT']."".APP_DIRECTORY."rad_modules/login/functions.php");
	include_once($_SERVER['DOCUMENT_ROOT']."".APP_DIRECTORY."rad_modules/categories/functions.php");
	include_once($_SERVER['DOCUMENT_ROOT']."".APP_DIRECTORY."rad_modules/tags/functions.php");
	include_once($_SERVER['DOCUMENT_ROOT']."".APP_DIRECTORY."rad_modules/quotes/functions.php");

	include_once($_SERVER['DOCUMENT_ROOT']."".APP_DIRECTORY."pip_boy_MVC/fusion_core_Models/blog.functions.php");	
	include_once($_SERVER['DOCUMENT_ROOT']."".APP_DIRECTORY."pip_boy_MVC/fusion_core_Models/store.functions.php");
	include_once($_SERVER['DOCUMENT_ROOT']."".APP_DIRECTORY."pip_boy_MVC/fusion_core_Models/pages.functions.php");

/*****************************************************************/



/**
  * @desc	block specific country access with API from http://ipinfo.io/
  * @param	
  * @return 
*/
	$blockedCountries = ['RU', 'CN', 'KP'];
	$apiToken = IPINFO_API_KEY;
	blockCountries_Security($blockedCountries, $apiToken);
/*****************************************************************/



/**
  * @desc	set db specific function names based on database type
  * @param	DB_TYPE
  * @return $session vars
*/
	connection_Database(DB_TYPE);
	
	if(!isset($_SESSION['QUERY']))
	{
		if(DB_TYPE == "MYSQL")
		{	
			$_SESSION['QUERY'] = "mysqli_query";
			$_SESSION['NUM_ROWS'] = "mysqli_num_rows";
			$_SESSION['FETCH_ARRAY'] = "mysqli_fetch_array";
			$_SESSION['QUERY_ERROR'] = "mysqli_error";
		}
		elseif(DB_TYPE == "MSSQL")
		{
			$_SESSION['QUERY'] = "sqlsrv_query";
			$_SESSION['NUM_ROWS'] = "sqlsrv_num_rows";
			$_SESSION['FETCH_ARRAY'] = "sqlsrv_fetch_array";
			$_SESSION['QUERY_ERROR'] = "sqlsrv_error";		
		}
	}
/*****************************************************************/


/**
  * @desc	array of form vars not to include in posted loop when 
  *			creating or updating records etc.	
  * @param	
  * @return 
*/
	
	if(!isset($_SESSION['ignore']))
	{
		$_SESSION['ignore'] = array("create","update","delete","multiselect","CONTENT_ID","CONTENT_LAYOUT_ID",
									"CONTENT_TEMPLATE_ID","CONTENT_TYPE_ID","GEOLOCATOR_ID","IP_LOG_ID","USER_ID",
									"VIDEO_ID","VIDEO_SERIES_ID","VIDEO_CATEGORY_ID");
	}
/*****************************************************************/ 


 
/**
  * @desc	this should only be changed following installation.
  * 		modifying this in ayway once data has been added will 
  *			render all encrypted values unreadable
  * @param	
  * @return 
*/

	define("ENCRYPTION_KEY", "otdKU2Aa!zIn");

/*****************************************************************/


?>
