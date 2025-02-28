<?php
/* MODULES.HOME.CONTROLLER */
/*****************************************************************/

	$seo_social_data['title'] = "";
	$seo_social_data['content_intro'] = "";
	$seo_social_data['created_at'] = "";
	$seo_social_data['image_primary'] = "";
	
	$pages = read_Pages($_REQUEST['alias']);
	
	include($_SERVER['DOCUMENT_ROOT'].''.APP_URL.'pip_boy_MVC/wasteland_Views/pages/index.php');
	exit;

?>