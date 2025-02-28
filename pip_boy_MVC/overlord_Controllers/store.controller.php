<?php
/* MODULES.HOME.CONTROLLER */
/*****************************************************************/

	$seo_social_data['title'] = "";
	$seo_social_data['content_intro'] = "";
	$seo_social_data['created_at'] = "";
	$seo_social_data['image_primary'] = "";
	
	$type = determine_alias_type($_REQUEST['alias']);
	
	if($type == "category"){
		$get_all_store_items = get_store_items_by_category($_REQUEST['alias']);
		include($_SERVER['DOCUMENT_ROOT'].''.APP_URL.'pip_boy_MVC/wasteland_Views/store/index.php');
		exit;
	}elseif($type == "product"){
		$get_store_item_details = get_store_item_details($_REQUEST['alias']);
		include($_SERVER['DOCUMENT_ROOT'].''.APP_URL.'pip_boy_MVC/wasteland_Views/store/store_detail.php');
		exit;
	}else{
	//view all items
		$get_all_store_items = get_all_store_items();
		include($_SERVER['DOCUMENT_ROOT'].''.APP_URL.'pip_boy_MVC/wasteland_Views/store/index.php');
		exit;
	}
	
	
	exit;

?>