<?php
/* MODULES.BLOG.CONTROLLER */
/*****************************************************************/

	$seo_social_data['title'] = "";
	$seo_social_data['content_intro'] = "";
	$seo_social_data['created_at'] = "";
	$seo_social_data['image_primary'] = "";
	
	$display_categories_Blog = read_categories_Blog();

/*
 * READ ALL BLOG POSTS
 *
*/ 
	$type = determine_alias_type($_REQUEST['alias']);
	
	if($type == "blog"){
		$get_all_store_items = get_store_items_by_category($_REQUEST['alias']);
		include($_SERVER['DOCUMENT_ROOT'].''.APP_URL.'pip_boy_MVC/wasteland_Views/blog/layout1.php');
		exit;
	}elseif($type == "blog_categories"){
		$get_store_item_details = get_store_item_details($_REQUEST['alias']);
		include($_SERVER['DOCUMENT_ROOT'].''.APP_URL.'pip_boy_MVC/wasteland_Views/blog/layout1.php');
		exit;
	
	}else{
	//view all items
		$get_all_store_items = get_all_store_items();
		include($_SERVER['DOCUMENT_ROOT'].''.APP_URL.'pip_boy_MVC/wasteland_Views/blog/post.php');
		exit;
	}

?>