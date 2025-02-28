<?php
/* _SYSTEM.URL */
/*****************************************************************/


/**
  * @desc	url to the root of the app
  * @param	
  * @return $site_url
*/
	function get_Url()
	{
		// Check if the request is HTTPS
		$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';

		// Get the hostname
		$host = $_SERVER['HTTP_HOST'];

		// Get the URI (path and query string)
		$uri = $_SERVER['REQUEST_URI'];

		// Combine all parts to form the URL
		return $protocol . $host;
	}
/*****************************************************************/



/**
  * @desc	core images for the UI of the website including logos, icons etc.
  *			NOT for blog images, product images ect.
  * @param	
  * @return $image_url
*/
	function images_Url()
	{
		$var = get_URL().''.APP_URL.'bottle_cap_Assets/images/';
		return $var;
	}
/*****************************************************************/



/**
  * @desc	images specifically for blog posts
  * @param	
  * @return $images_url
*/
	function blog_images_Url()
	{
		$var = get_URL().''.APP_URL.'bottle_cap_Assets/images_blog/';
		return $var;
	}
/*****************************************************************/



/**
  * @desc	images specifically for store items
  * @param	
  * @return $products_images_url
*/
	function store_images_Url()
	{
		$var = get_URL().''.APP_URL.'bottle_cap_Assets/images_store/';
		return $var;
	}
/*****************************************************************/



/**
  * @desc	determine the database the uri passed belongs to
  * @param	
  * @return $products_images_url
*/
function identify_alias_Url($alias=FALSE) {
   $conn = connection_Database();
   	
// Check if it's a home
	if($alias == "home"){
	   $_SESSION['view'] = "home";
	   return 'home';
	}

// Check if it's a blog
	$blog_query = "SELECT 'blog' as type FROM blogs WHERE alias = ? AND deleted_at IS NULL";
	$stmt = mysqli_prepare($conn, $blog_query);
	mysqli_stmt_bind_param($stmt, 's', $alias);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	if (mysqli_num_rows($result) > 0) {
	   mysqli_stmt_close($stmt);
	   mysqli_close($conn);
	   
	   $_SESSION['view'] = "blog";
	   return 'blog';
	}
	mysqli_stmt_close($stmt);

// Check if it's a blog_categories
	$blog_categories_query = "SELECT 'blog_categories' as type FROM blog_categories WHERE alias = ?";
	$stmt = mysqli_prepare($conn, $blog_categories_query);
	mysqli_stmt_bind_param($stmt, 's', $alias);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	if (mysqli_num_rows($result) > 0) {
	   mysqli_stmt_close($stmt);
	   mysqli_close($conn);
	   
	   $_SESSION['view'] = "blog_categories";
	   return 'blog_categories';
	}
	mysqli_stmt_close($stmt);

// Check if it's a store item  
	if($alias == "store"){
	   $_SESSION['view'] = "store";
	   return 'store';
	}
	$store_query = "SELECT 'store' as type FROM store WHERE alias = ? AND deleted_at IS NULL";
	$stmt = mysqli_prepare($conn, $store_query);
	mysqli_stmt_bind_param($stmt, 's', $alias);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	if (mysqli_num_rows($result) > 0) {
	   mysqli_stmt_close($stmt);
	   mysqli_close($conn); 
	   
	   $_SESSION['view'] = "store";
	   return 'store';
	}

	mysqli_stmt_close($stmt);

// Check if it's a page  
	$page_query = "SELECT 'pages' as type FROM pages WHERE alias = ?";
	$stmt = mysqli_prepare($conn, $page_query);
	mysqli_stmt_bind_param($stmt, 's', $alias);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	if (mysqli_num_rows($result) > 0) {
	   mysqli_stmt_close($stmt);
	   mysqli_close($conn); 
	   
	   $_SESSION['view'] = "page";
	   return 'page';
	}

	mysqli_stmt_close($stmt);
	mysqli_close($conn);

// Check if it's other 
	return 'other';
}











/**
  * @desc	url to the root of the app
  * @param	
  * @return $site_url
*/
	function site_Url()
	{
		$site_url = $_SERVER['HTTP_HOST'];
		return $site_url;
	}
/*****************************************************************/



/**
  * @desc	url to the root of the app
  * @param	
  * @return $site_url
*/
	function subdomain_Url()
	{
		$URL = $_SERVER['HTTP_HOST'];
  
		// Split string into array
		$arr = explode('.', $URL);
  
		// Get the first element of array
		$subdomain = $arr[0];
  
		return $subdomain;
	}
/*****************************************************************/



/**
  * @desc	dir structure root of the app
  * @param	
  * @return $root_url
*/
	function root_app_Url()
	{
		$root_url = $_SERVER['DOCUMENT_ROOT'].''.APP_DIRECTORY;
		return $root_url;
	}
/*****************************************************************/



/**
  * @desc	dir structure root of the app
  * @param	
  * @return $root_url
*/
	function root_Url()
	{
		$root_url = $_SERVER['DOCUMENT_ROOT'].'\\';
		return $root_url;
	}
/*****************************************************************/







/**
  * @desc	url the user is on
  * @param	
  * @return $root_url
*/
	function current_page_Url()
	{
		$pageURL = 'http';
		if ($_SERVER["HTTPS"] == "on") 
		{	
			$pageURL .= "s";
		}
		
		$pageURL .= "://";
		
		if ($_SERVER["SERVER_PORT"] != "80") 
		{
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}

		return $pageURL;
	}
/*****************************************************************/

?>