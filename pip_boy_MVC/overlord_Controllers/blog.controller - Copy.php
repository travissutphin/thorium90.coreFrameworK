<?php
/* MODULES.BLOG.CONTROLLER */
/*****************************************************************/

	$seo_social_data['created_at'] = "";
	$seo_social_data['image_primary'] = "";
	
	if(!isset($_REQUEST['alias'])) { 
		$_REQUEST['alias'] = NULL; 
	} 

	/* IF ALIAS IS A BLOG POST - DISPLAY BLOG DETAIL POST */
	$is_blog = read_blog($alias=$_REQUEST['alias']);
	echo $_SESSION['NUM_ROWS']($is_blog);
	
	/* IF ALIAS IS A CATEGORY - DISPLAY ALL BLOG POSTS IN CATEGORY */
	$is_category = read_Categories($id=FALSE, $category=$_REQUEST['alias']);

	/* IF ALIAS IS A TAG - DISPLAY ALL BLOG POSTS IN TAG */
	$is_tag = read_Tags($id=FALSE, $tag=$_REQUEST['alias']);
	
	/* ELSE SHOW ALL BLOG POSTS IN DESCENDING ORDER */

	
	// DO NOT SHOW LATEST POST NOR TOP CATEGORIES BY DEFAULT
	$show_latest_post = 'no';
	$show_top_categories = 'no';
	$seo_social_data = read_values_Blog($_REQUEST['alias']);

	if(isset($_REQUEST['search_criteria']) and $_REQUEST['search_criteria'] != ""){
		
		//$display_blog = read_blog($id=FALSE, $alias=FALSE, $created_at=FALSE, $limit=FALSE, $category=FALSE, $tag=FALSE,  $search_criteria=$_REQUEST['search_criteria']);
		//include('templates/blog.php');

	}elseif($_SESSION['NUM_ROWS']($is_blog) == 1){ // BLOG POST DETAILS

		$display_post = read_blog($id=FALSE, $alias=$_REQUEST['alias'], $created_at=FALSE, $limit=FALSE, $category=FALSE, $tag=FALSE,  $search_criteria=FALSE);
		$display_post_image = read_blog($id=FALSE, $alias=$_REQUEST['alias'], $created_at=FALSE, $limit=FALSE, $category=FALSE, $tag=FALSE,  $search_criteria=FALSE);
		$seo_social_data = read_values_Blog($_REQUEST['alias']);
		include('pip_boy_MVC/wasteland_Views/blog/post.php');
			
	}elseif($_SESSION['NUM_ROWS']($is_category) == 1){

		$display_blog = read_blog($id=FALSE, $alias=FALSE, $created_at=FALSE, $limit=FALSE, $category=$_REQUEST['alias'], $tag=FALSE,  $search_criteria=FALSE);
		include('templates/blog.php');


	}elseif($_SESSION['NUM_ROWS']($is_tag) == 1){
		
		//$display_blog = read_by_tag_Blog($tag=$_REQUEST['alias']);
		$get_id = read_Tags($id=FALSE, $alias=$_REQUEST['alias']);

			while($row = mysqli_fetch_array($get_id)) {
				$tagid = $row['id'];
			}
		$display_blog = read_blog($id=FALSE, $alias=FALSE, $created_at=FALSE, $limit=FALSE, $category=FALSE, $tag=$tagid,  $search_criteria=FALSE);
		include('templates/blog.php');

			
	}else{ // SHOW ALL BLOG POSTS

		$show_latest_post = 'no';
		$show_top_categories = 'no';

		$display_all_posts = read_blog($id=FALSE, $alias=FALSE, $created_at=FALSE, $limit=FALSE); // PARTS IN THE SERIES ARE "YES" AND THE OVERVIEW TO THOSE SERIES ARE NULL AS ARE ALL SINGLE BLOG POSTS
		$display_latest_post = read_blog($id=FALSE, $alias=FALSE, $created_at=FALSE, $limit='0,1');
		
		include('pip_boy_MVC/wasteland_Views/blog/layout1.php');
			
	}
	
?>