<?php
/* BLOG.FUNCTIONS */
/*****************************************************************/

/** 
  * @desc	create record
  * @param	
  * @return none - redirect will occure accordingly
*/
	function create_()
	{	  
	  $sql = "INSERT INTO table
			  (column) 
			  VALUES ('value') " ;
	  
	  $result = mysql_query($sql,database_connection()) or die (mysql_error());	
	}
/*****************************************************************/

/** 
  * @desc	read data from table
  * @param	$id
  * @return complete query structure
*/
	function read_blog($id=FALSE, $alias=FALSE, $created_at=FALSE, $limit=FALSE, $category=FALSE, $tag=FALSE, $search_criteria=FALSE, $part_of_series=FALSE)
	{
		$conn = connection_Database();
		
		$sql = ' SELECT b.id, b.title, b.alias, b.content_full, b.content_intro, b.meta_title, b.meta_description, b.part_of_series, b.image_primary, b.video_primary, b.search_criteria, b.knowledge_by_percentage, b.created_by, b.created_at, b.deleted_at, bc.category, bc.alias AS bcalias ';
		$sql.= ' FROM blogs b ';
		if($tag !== FALSE){ $sql.= ' JOIN blog_x_tags bxt ON bxt.blog_fk = b.id '; }
		$sql.= ' JOIN blog_x_categories bxc ON bxc.blog_fk = b.id ';
		$sql.= ' JOIN blog_categories bc ON bc.id = bxc.blog_category_fk ';
		$sql.= ' WHERE CURDATE() >= b.created_at ';

		if($id !== FALSE){
			$sql.= ' AND b.id = "'.$id.'" ';	  
		}

		if($alias !== FALSE){
			$sql.= ' AND b.alias = "'.$alias.'" ';	  
		}	

		if($category !== FALSE){
			$sql.= ' AND bc.alias = "'.$category.'" ';	  
		}	

		if($tag !== FALSE){
			$sql.= ' AND bxt.blog_tag_fk = "'.$tag.'" ';	  
		}
		
		if($search_criteria !== FALSE){
			$sql.= ' AND (b.search_criteria LIKE "%'.$search_criteria.'%" OR b.title LIKE "%'.$search_criteria.'%" OR b.content_full LIKE "%'.$search_criteria.'%" )';			
		}
		
		if($part_of_series !== FALSE){ // THESE ARE THE PARTS THAT MAKE UP A SERIES - THE "OVERVIEW" IS NOT PART OF THE SERIES
			$sql.= ' AND b.part_of_series IS NULL ';				
		}
		
		$sql.= ' ORDER BY b.created_at desc ';

		if($limit !== FALSE){
			$sql.= ' LIMIT '.$limit.' ';
		}

		$stmt = mysqli_prepare($conn, $sql);

		if (!$stmt) {
		   error_log("Query preparation failed: " . mysqli_error($conn));
		   return FALSE;
		}

		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		mysqli_stmt_close($stmt);

		return $result;
	}

/*****************************************************************/


/** 
  * @desc	read data from table
  * @param	$id
  * @return complete query structure
*/
	function read_images_blog($id=FALSE)
	{
		
		$sql = ' SELECT bi.id, bi.image, bi.alt ';
		$sql.= ' FROM blog_images bi ';
		$sql.= ' JOIN blogs b ON b.id = bi.blog_fk ';

		if($id !== FALSE){
			$sql.= ' AND bi.blog_fk = "'.$id.'" ';	  
		}
		
		$sql.= ' ORDER BY RAND() ';

		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
	  
		return $result;
	}
/*****************************************************************/


/** 
  * @desc	read data from table
  * @param	$id
  * @return complete query structure
*/
	function read_by_tag_Blog($tag=FALSE)
	{
		$get_id = read_Tags($id=FALSE, $alias=$tag);
		
		while($row = mysqli_fetch_array($get_id)) {
			$id = $row['id'];
		}
		
		$sql = ' SELECT b.id, b.title, b.alias, b.content_full, b.content_intro, b.meta_title, b.meta_description, b.image_primary, b.knowledge_by_percentage, b.created_by, b.created_at, b.deleted_at, bc.category ';
		$sql.= ' FROM blogs b ';
		$sql.= ' JOIN blog_x_tags bxt ON bxt.blog_fk = b.id ';
		$sql.= ' JOIN blog_x_categories bxc ON bxc.blog_fk = b.id ';
		$sql.= ' JOIN blog_categories bc ON bc.id = bxc.blog_category_fk ';
		$sql.= ' WHERE 0=0 AND CURDATE() >= b.created_at ';

		if($tag !== FALSE)	  {
			$sql.= ' AND bxt.blog_tag_fk = "'.$id.'" ';	  
		}
		
		$sql.= ' ORDER BY b.created_at desc ';

		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
	  
		return $result;
	}
/*****************************************************************/


/** 
  * @desc	read data from table
  * @param	$id
  * @return complete query structure
*/
	function read_Blog_Tags($id=FALSE)
	{
		$sql = ' SELECT bt.id, bt.tag, bt.alias ';
		$sql.= ' FROM blog_tags bt ';	
		$sql.= ' JOIN blog_x_tags bxt ON bxt.blog_tag_fk = bt.id  ';
		$sql.= ' WHERE 0=0 ';
	  
		if($id !== FALSE)	  {
			$sql.= ' AND bxt.blog_fk = "'.$id.'" ';	  
		}
	  
		$sql.= ' ORDER BY bt.tag ';

		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
	  
		return $result;
	}
/*****************************************************************/

/** 
  * @desc	read specific value
  * @param	$id
  * @return specific values of a record stored in an array
  * @to use	
  *		$array_data = read_values_($id);
  *		echo $array_data['id'];
*/
	function read_values_Blog($alias=FALSE)
	{
		$result = read_blog($id=FALSE, $alias, $created_at=FALSE, $limit=FALSE, $category=FALSE, $tag=FALSE); 

	
		if(!empty($result)){
		  while($data = mysqli_fetch_array($result))
		  {
			  $title = $data['title'];
			  $content_intro = $data['content_intro'];
			  $image_primary = $data['image_primary'];
			  $meta_title = $data['meta_title'];
			  $meta_description = $data['meta_description'];
			  $meta_created_at = $data['created_at'];
		  } 
		}
		
	  return array('id' => $id, 'title' => $title, 'content_intro' => $content_intro, 'meta_title' => $meta_title, 'meta_description' => $meta_description, 'image_primary' => $image_primary, 'created_at' => $meta_created_at);
	}
/*****************************************************************/

/** 
  * @desc	update
  * @param	$id (specific record)
  * @return none
*/
	function update_()
	{
	  $sql = "UPDATE table
			  SET 
			  column = '".$_POST['value']."' ,
			  column = '".$_POST['value']."'
			  WHERE id = '".$_POST['id']."'
			 ";
			 
	  $result = mysql_query($sql,database_connection()) or die (mysql_error());
	}
/*****************************************************************/

/** 
  * @desc	delete
  * @param	$id
  * @return none
*/
	function delete_($id="")
	{
	  if($id != "")
	  {
		$sql = 'DELETE FROM table
				WHERE id = "'.$id.'" ';
					  
		$result = mysql_query($sql,database_connection()) or die (mysql_error());
	  }
	}
/*****************************************************************/

/** 
  * @desc	create an html select list
  * @param	$id(selected record) - $value(class, id, etc)
  * @return none - echo out list
*/
	function html_list_($id=FALSE,$values=FALSE)
	{
	  $sql = " SELECT * FROM table ";	
	  $sql.= ' ORDER BY column';
	  
	  $result = mysql_query($sql,database_connection()) or die (mysql_error());
	  
	  echo '<select name="id" "'.$values.'">';
	  while($row = mysql_fetch_array($result))
	  {
		if($row['id'] == $id){ $selected="selected"; }else{ $selected=""; }
		echo '<option value="'.$row['id'].'" '.$selected.'>'.$row['value'].'</option>';  
	  }
	  echo '</select>';
	}
/*****************************************************************/

?>