<?php
/* _SYSTEM.SECURITY */
/*****************************************************************/


/**
  * @desc	specify who has access to a page
  * @param	
  * @return 
  * @edited	2024-11 php 8.3
*/
function validate_admin_session_Security() 
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    // Check if user session exists and is an admin
    if (empty($_SESSION['users']) || $_SESSION['users']['role'] !== 'admin') {
        header('Location: login.php');
        exit;
    }

    // Check for IP and User-Agent consistency
    if ($_SESSION['users']['ip_address'] !== $_SERVER['REMOTE_ADDR'] ||
        $_SESSION['users']['user_agent'] !== $_SERVER['HTTP_USER_AGENT']) {
		clear_variables_Login();
		$_SESSION['message'] = "timed_out";
        header('Location: login.php');
        exit;
    }

    // Enforce inactivity timeout (e.g., 15 minutes)
    if (time() - $_SESSION['users']['last_activity'] > INACTIVITY_TIMEOUT) { // set as define in config
		clear_variables_Login();
        $_SESSION['message'] = "timed_out";
		header('Location: login.php');
        exit;
    }
	
	// Check if the session has expired based on total session lifetime
    if (($current_time - $_SESSION['users']['login_time']) > SESSION_LIFETIME) { // set as define in config
		clear_variables_Login();
		$_SESSION['message'] = "timed_out";
        header('Location: login.php');
        exit;
    }

    // Update last activity timestamp
    $_SESSION['users']['last_activity'] = time();
}
/*****************************************************************/



/**
  * @desc   Checks if the session ID needs regeneration based on a time interval, regenerating it if necessary to reduce session hijacking risks.
  * @param  none
  * @return none
  * @edited	2024-11 php 8.3
*/
function check_and_regenerate_session_Security() 
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    // Set the time interval for regeneration (e.g., 5 minutes)
    $regeneration_interval = 300; // 300 seconds = 5 minutes

    // Check if it's time to regenerate the session ID
    if (isset($_SESSION['last_regeneration'])) {
        if (time() - $_SESSION['last_regeneration'] > $regeneration_interval) {
            session_regenerate_id(true);
            $_SESSION['last_regeneration'] = time(); // Update regeneration timestamp
        }
    } else {
        // If 'last_regeneration' isn't set, initialize it
        $_SESSION['last_regeneration'] = time();
    }
}
/*****************************************************************/



/**
  * @desc	specify who has access to a page
  * @param	
  * @return 
*/
	function has_access_to_page_Security($permission)
	{
		if($_SESSION['user.role'] != $permission)
		{
			header('Location: '.site_Url().'control_panel/view.php');
			exit;
		}
	}
/*****************************************************************/


/**
  * @desc	no direct access to php page
  * @param	
  * @return 
*/
	function prevent_direct_access_Security()
	{
		if($_SERVER['REQUEST_URI'] == $_SERVER['PHP_SELF'])
		{
			header('Location: '.site_Url().'templates/404.php');
		}
	}
/*****************************************************************/



/**
  * @desc	no direct access to php page
  * @param	
  * @return 
*/
function check_session_expiry_Security() {

    // Ensure login time is set
    if (isset($_SESSION['users']['login_time'])) { // set in /* LOGIN.FUNCTIONS */
        $current_time = time();

        // Check if the session has expired based on total session lifetime
        if (($current_time - $_SESSION['users']['login_time']) > SESSION_LIFETIME) {
            logout_user('Session expired due to maximum session lifetime.');
        }

        // Check if the session has expired due to inactivity
        if (($current_time - $_SESSION['users']['last_activity']) > INACTIVITY_TIMEOUT) {
            logout_user('Session expired due to inactivity.');
        }

        // Update the last activity timestamp for active session
        $_SESSION['users']['last_activity'] = $current_time;
    } else {
        // If login time is not set, logout for safety
        logout_user('Invalid session. Please log in again.');
    }
}
/*****************************************************************/



// Function to log out user and redirect
function logout_user($message) {
    // Optional: Store the logout message in session to display on the login page
    $_SESSION['message'] = $message;

    // Clear all session variables and destroy the session
    session_unset();
    session_destroy();

    // Redirect to login page
    header('Location: login.php');
    exit;
}



/**
  * @desc	check that user is logged in
  * @param	
  * @return 
*/
	function is_logged_in_Security() 
	{		
		$inactive = 3600; // set timeout period in seconds

		if(!isset($_SESSION['user.is_logged_in']))
		{
			session_destroy();
			header( 'Location: '.app_Url().'login/' );
			exit;
		}
		
		// check to see if $_SESSION['timeout'] is set
		if(isset($_SESSION['timeout']) ) {
			$session_life = time() - $_SESSION['timeout'];
			if($session_life > $inactive)
				{ 
				// go to login page when idle
				session_destroy(); 
				header( 'Location: '.app_Url().'login/' ); 
			}
		}
		$_SESSION['timeout'] = time();
	}
/*****************************************************************/

/**
  * @desc	Returns an encrypted & utf8-encoded
  * @param	$pure_string, $encryption_key
  * @return $encrypted_string
*/
	function encrypt_Security($value, $salt)
	{ 
    	$password = md5($salt.$value); 
		return $password;
	} 
/*****************************************************************/

/**
  * @desc	access from within this function only
  * @param	$sData
  * @return $sBase64
*/
	function encode_base64($sData)
	{ 
		$sBase64 = base64_encode($sData); 
		return strtr($sBase64, '+/', '-_'); 
	} 
	
	function decode_base64($sData)
	{ 
		$sBase64 = strtr($sData, '-_', '+/'); 
		return base64_decode($sBase64); 
	}  
/*****************************************************************/



/**
  * @desc	Sanitize database inputs, trim and addslashes
  * @param	$input
  * @return $output
*/
function cleanInput_Security($input,$extra_option=FALSE) {
	
	// if value is an arrary
	if (is_array($input)) {
		foreach($input as $var => $val) {
			$output[$var] = sanitize_Security($val,$extra_option);
		}
	}else{ // not an array
		$output = sanitize_Security($input,$extra_option);	

	}
	if($output != ""){
		$output = trim($output);
	}
	
	return $output;
}

function sanitize_Security($input,$extra_option) {
	
	$search = array(
		  '@<script[^>]*?>.*?</script>@si',   // Strip out javascripyt
		);
		
	$output = preg_replace($search, '', $input);
	$output = trim($output);			
	$output = stripslashes($output);
	$output = mysqli_real_escape_string($_SESSION['connection'], $output);
	
	if($extra_option != FALSE and $extra_option = 'encrypt')
	{
		$output = encrypt_Security(trim($output),ENCRYPTION_KEY);
	}
		
	return $output;
}
/*****************************************************************/

/**
  * @desc	get IP addres of user even if user behind proxy server 
  * @param	
  * @return $ip
*/
	function detect_ip_address_Security()
	{
		if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
		{
			$ip=$_SERVER['HTTP_CLIENT_IP'];
		}
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
		{
			$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else
		{
			$ip=$_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}
/*****************************************************************/



/**
  * @desc	Detects the location of users IP address
  * @param	$ip
  * @return $location (city and state)
  * @WARNING - this is the IP location, not exacly where the user is
*/
	function detect_city_state_Security($ip) 
	{ 
        $default = 'UNKNOWN';

        if (!is_string($ip) || strlen($ip) < 1 || $ip == '127.0.0.1' || $ip == 'localhost')
            $ip = '8.8.8.8';

        $curlopt_useragent = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.2) Gecko/20100115 Firefox/3.6 (.NET CLR 3.5.30729)';
        
        $url = 'http://ipinfodb.com/ip_locator.php?ip=' . urlencode($ip);
        $ch = curl_init();
        
        $curl_opt = array(
            CURLOPT_FOLLOWLOCATION  => 1,
            CURLOPT_HEADER      => 0,
            CURLOPT_RETURNTRANSFER  => 1,
            CURLOPT_USERAGENT   => $curlopt_useragent,
            CURLOPT_URL       => $url,
            CURLOPT_TIMEOUT         => 1,
            CURLOPT_REFERER         => 'http://' . $_SERVER['HTTP_HOST'],
        );
        
        curl_setopt_array($ch, $curl_opt);
        
        $content = curl_exec($ch);
        
        if (!is_null($curl_info)) {
            $curl_info = curl_getinfo($ch);
        }
        
        curl_close($ch);
        
        if ( preg_match('{<li>City : ([^<]*)</li>}i', $content, $regs) )  {
            $city = $regs[1];
        }
        if ( preg_match('{<li>State/Province : ([^<]*)</li>}i', $content, $regs) )  {
            $state = $regs[1];
        }

        if( $city!='' && $state!='' ){
          $location = $city . ', ' . $state;
          return $location;
        }else{
          return $default; 
        }
        
    }
/*****************************************************************/



/**
  * @desc	Detects the user location via IP address and block if in $blockedCountries array
  * @param	$blockedCountries, $apiToken
  * @return 
*/
	function blockCountries_Security($blockedCountries, $apiToken) 
	{
		$userIP = $_SERVER['REMOTE_ADDR'];
		$url = "http://ipinfo.io/{$userIP}/json?token={$apiToken}";
		$userInfo = json_decode(file_get_contents($url));
		
		if (isset($userInfo->country) && in_array($userInfo->country, $blockedCountries)) {
			die("Access denied from your country.");
		}
	}