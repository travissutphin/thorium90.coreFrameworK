<?php
/* ROOT.CONTROLLER */
/*****************************************************************/
$message = isset($_SESSION['message']) ? $_SESSION['message'] : false;
	
/************
*
*	VERIFY US BASED IP ADDRESS
*
*
************/
/*
$IPaddress = $_SERVER['REMOTE_ADDR'];
$two_letter_country_code = iptocountry($IPaddress);
include("assets/ip_files/countries.php");
$three_letter_country_code=$countries[ $two_letter_country_code][0];
$country_name=$countries[$two_letter_country_code][1];
if($two_letter_country_code != 'US'){
	include('templates/nonUS.php');
	exit;
	
}
*/
/************
*
*	LOAD ALL FUNCTIONS NEEDED FOR GLOBAL USAGE
*
*
************/


/************
*
*	GLOBAL NAVIGATION IN THE HEAD.PHP FILE
*
*
************/
$display_categories_nav = read_Categories($id=FALSE, $category=FALSE);
$display_tags_nav = read_Tags($id=FALSE, $tag=FALSE);


/************
*
*	ON BLOG.PHP FILE TO SHOW THE MOST RECENT POST
*
*
************/
$latest_blog = read_blog($id=FALSE, $alias=FALSE, $created_at=FALSE, $limit='0,1');


/************
*
*	ON BLOG.PHP FILE RIGHT COLUMN TO SHOW ALL CATEGORIES AND TAGS
*
*
************/
$display_tags_blog = read_Tags($id=FALSE, $tag=FALSE);
$display_categories_blog = read_Categories($id=FALSE, $category=FALSE);


/************
*
*	ON BLOG.PHP FILE BELOW POSTS
*
*
************/
$random_quote = read_Quotes();



/************
*
*	SET VIEW BASED ON ALIAS
*
*
************/
	
	if($_REQUEST['alias'] == "the-vault"){
		include('the-vault/controller.php');
		exit;
	}		
	
	if(!isset($_REQUEST['alias'])){ 
		$_REQUEST['alias'] = "home";
	}
	identify_alias_Url($_REQUEST['alias']);
	

/**********************************************************************************/


/************
*
*	LOAD CONTROLLER BASED ON $_Request['alias']
*
*
************/

	if(isset($_SESSION['view']) and $_SESSION['view'] == "blog"){

		include('pip_boy_MVC/overlord_Controllers/blog.controller.php');
		exit;
		
	}elseif(isset($_SESSION['view']) and $_SESSION['view'] == "store"){
		
		include('pip_boy_MVC/overlord_Controllers/store.controller.php');
		exit;
		
	}elseif(isset($_SESSION['view']) and $_SESSION['view'] == "home"){
		
		include('pip_boy_MVC/overlord_Controllers/home.controller.php');
		exit;	
		
	}elseif(isset($_SESSION['view']) and $_SESSION['view'] == "page"){
		
		include('pip_boy_MVC/overlord_Controllers/pages.controller.php');
		exit;	
		
	}elseif(isset($_SESSION['view']) and $_SESSION['view'] == "thorium90-framework"){
		
		include('pip_boy_MVC/overlord_Controllers/goal.controller.php');
		exit;	
		
	}
	
/**********************************************************************************/


	// THE ACTION SESSION SHOULD ONLY BE USED ONCE
	unset($_SESSION['action']);

?>