<?php
/* MODULES.PRODUCTS.CONTROLLER */
/*****************************************************************/

	$seo_social_data['title'] = "";
	$seo_social_data['content_intro'] = "";
	$seo_social_data['created_at'] = "";
	$seo_social_data['image_primary'] = "";
	
	
	// view all categories
	if(isset($_SESSION['view']) and $_SESSION['view'] == "store")
	{ 
		
		if(isset($_REQUEST['alias']) and $_REQUEST['alias'] == "store"){
			//view all categories
			$view_product_categories = read_product_categories($id = null);
			include($_SERVER['DOCUMENT_ROOT'].'templates/store.php');
			exit;
		
		}elseif(isset($_REQUEST['alias'])){
			// view all products in the alias category	
			$view_product = read_product($_REQUEST['alias']);
			include($_SERVER['DOCUMENT_ROOT'].'templates/store_products.php');
			exit;
		
		}
	}

?>