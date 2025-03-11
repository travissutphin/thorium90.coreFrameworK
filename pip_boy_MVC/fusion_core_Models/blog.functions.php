<?php
/* BLOG.FUNCTIONS */
/*****************************************************************/

/**
 * Create a new blog entry.
 *
 * This function constructs and executes a SQL query to insert a new blog entry into the database.
 * It supports inserting data for the blog title, alias, content, meta title, meta description, and more.
 * It also ensures security by escaping the input and using prepared statements.
 *
 * @param string $title           The title of the blog entry.
 * @param string $alias           The alias of the blog entry.
 * @param string $contentFull     The full content of the blog entry.
 * @param string $contentIntro    The introductory content of the blog entry.
 * @param string $metaTitle       The meta title of the blog entry.
 * @param string $metaDescription The meta description of the blog entry.
 * @param int    $categoryId      The ID of the category the blog entry belongs to.
 * @param int    $tagId           The ID of the tag the blog entry belongs to.
 * @param string $searchCriteria  The search criteria for the blog entry.
 * @param bool   $partOfSeries    Whether the blog entry is part of a series.
 * @param int    $createdBy       The ID of the user who created the blog entry.
 * @param array  $fileData        The uploaded file data from $_FILES.
 * @return int|false              The ID of the newly created blog entry, or false on failure.
 */
function create_Blog(
	$title,
	$alias,
	$contentFull,
	$contentIntro,
	$metaTitle,
	$metaDescription,
	$categoryId,
	$tagId,
	$searchCriteria,
	$partOfSeries,
	$createdBy,
	$fileData
) {
	// Establish a database connection
	$connection = connectionDatabase();

	// Prepare the SQL statement
	// This statement is a parameterized query which is used to insert a new blog entry
	// into the database.
	$sql = '
		INSERT INTO blogs (
			title,
			alias,
			content_full,
			content_intro,
			meta_title,
			meta_description,
			category_id,
			tag_id,
			search_criteria,
			part_of_series,
			created_by,
			created_at,
			image_primary
		) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?)
	';

	// Verify that the connection is valid
	// If the connection is not valid, log the error and return false
	if (!$connection) {
		error_log('Connection to the database failed: ' . mysqli_connect_error());
		return false;
	}

	// Prepare the statement
	// The statement is prepared with the SQL query and the connection
	$stmt = mysqli_prepare($connection, $sql);
	if (!$stmt) {
		// Log error if statement preparation fails
		// If the statement preparation fails, log the error and return false
		error_log("Query preparation failed: " . mysqli_error($connection));
		return false;
	}

	// Escape all parameters
	// The parameters are escaped with the mysqli_real_escape_string function
	// to prevent SQL injection attacks
	$title = mysqli_real_escape_string($connection, $title);
	$alias = mysqli_real_escape_string($connection, $alias);
	$contentFull = mysqli_real_escape_string($connection, $contentFull);
	$contentIntro = mysqli_real_escape_string($connection, $contentIntro);
	$metaTitle = mysqli_real_escape_string($connection, $metaTitle);
	$metaDescription = mysqli_real_escape_string($connection, $metaDescription);
	$searchCriteria = mysqli_real_escape_string($connection, $searchCriteria);


	// Handle the uploaded image
	$imagePath = null; // Initialize image path
	if (isset($fileData['image']) && $fileData['image']['error'] === UPLOAD_ERR_OK) {
		$uploadDir = 'uploads/'; // Directory to save uploaded images
		$fileName = basename($fileData['image']['name']);
		$targetFilePath = $uploadDir . $fileName;

		// Move the uploaded file to the target directory
		if (move_uploaded_file($fileData['image']['tmp_name'], $targetFilePath)) {
			// Resize the image
			$resizedFilePath = $uploadDir . 'resized_' . $fileName; // Path for the resized image
			$resizeSuccess = resize_Images($targetFilePath, $resizedFilePath, BLOG_IMAGE_LENGTH, BLOG_IMAGE_WIDTH, BLOG_IMAGE_CROP); // Defined in Config

			if ($resizeSuccess) {
				$imagePath = $resizedFilePath; // Set the image path to the resized image
			} else {
				error_log("Image resizing failed for: " . $targetFilePath);
			}
		} else {
			error_log("Failed to move uploaded file: " . $fileData['image']['error']);
		}
	}

	// Bind parameters to the statement
	// The parameters are bound to the statement with the mysqli_stmt_bind_param function
	// The parameters are bound in the order they are specified in the SQL query
	mysqli_stmt_bind_param(
		$stmt,
		'sssssssiisii',
		$title,
		$alias,
		$contentFull,
		$contentIntro,
		$metaTitle,
		$metaDescription,
		$categoryId,
		$tagId,
		$searchCriteria,
		$partOfSeries,
		$createdBy,
		$imagePath
	);

	// Execute the statement
	// The statement is executed with the mysqli_stmt_execute function
	// If the statement execution fails, log the error and return false
	if (!mysqli_stmt_execute($stmt)) {
		error_log("Query execution failed: " . mysqli_stmt_error($stmt));
		return false;
	}

	// Get the ID of the newly created blog entry
	// The ID of the newly created blog entry is retrieved with the
	// mysqli_stmt_insert_id function
	$blogId = mysqli_stmt_insert_id($stmt);

	// Close the statement
	// The statement is closed with the mysqli_stmt_close function
	mysqli_stmt_close($stmt);

	// Return the ID of the newly created blog entry
	// The ID of the newly created blog entry is returned
	return $blogId;
}

/**
 * Read data from the blogs table based on various criteria.
 *
 * This function constructs and executes a SQL query to fetch data from the blogs table.
 * It supports filtering by several parameters such as ID, alias, category, tag, search criteria, 
 * and whether the blog is part of a series. The results can also be limited to a specified number.
 *
 * @param int|false $id              Optional blog ID to filter by.
 * @param string|false $alias        Optional blog alias to filter by.
 * @param string|false $createdAt    Unused parameter, kept for compatibility.
 * @param int|false $limit           Optional limit on the number of results.
 * @param string|false $category     Optional category alias to filter by.
 * @param int|false $tag             Optional tag ID to filter by.
 * @param string|false $searchCriteria Optional search string to filter by title, content, or search criteria.
 * @param bool|false $partOfSeries   Optional flag to filter blogs that are not part of a series.
 * @return mysqli_result|false       Returns the result set on success, or false on failure.
 */
function read_Blog($id = false, $alias = false, $createdAt = false, $limit = false, $category = false, $tag = false, $searchCriteria = false, $partOfSeries = false)
{
    // Establish a database connection
    $connection = connectionDatabase();

    // Base SQL query to select blog data and join with categories
    $sql = '
        SELECT b.id, b.title, b.alias, b.content_full, b.content_intro, b.meta_title, b.meta_description, 
               b.part_of_series, b.image_primary, b.video_primary, b.search_criteria, b.knowledge_by_percentage, 
               b.created_by, b.created_at, b.deleted_at, bc.category, bc.alias AS category_alias
        FROM blogs b
        JOIN blog_x_categories bxc ON bxc.blog_fk = b.id
        JOIN blog_categories bc ON bc.id = bxc.blog_category_fk
    ';

    // Initialize an array for SQL WHERE clauses
    $clauses = ['CURDATE() >= b.created_at']; // Ensure the blog is published
    $params = []; // Parameters for prepared statement
    $types = '';  // Types for prepared statement parameters

    // Add clauses and parameters based on provided arguments
    if ($id !== false) {
        $clauses[] = 'b.id = ?';
        $params[] = $id;
        $types .= 'i'; // Integer type
    }

    if ($alias !== false) {
        $clauses[] = 'b.alias = ?';
        $params[] = $alias;
        $types .= 's'; // String type
    }

    if ($category !== false) {
        $clauses[] = 'bc.alias = ?';
        $params[] = $category;
        $types .= 's'; // String type
    }

    if ($tag !== false) {
        // Join with tags table if tag filter is applied
        $sql .= ' JOIN blog_x_tags bxt ON bxt.blog_fk = b.id ';
        $clauses[] = 'bxt.blog_tag_fk = ?';
        $params[] = $tag;
        $types .= 'i'; // Integer type
    }

    if ($searchCriteria !== false) {
        // Add search criteria for multiple columns
        $clauses[] = '(b.search_criteria LIKE ? OR b.title LIKE ? OR b.content_full LIKE ?)';
        $searchCriteriaLike = '%' . $searchCriteria . '%'; // Wildcard search
        $params[] = $searchCriteriaLike;
        $params[] = $searchCriteriaLike;
        $params[] = $searchCriteriaLike;
        $types .= 'sss'; // String types
    }

    if ($partOfSeries !== false) {
        // Filter out blogs that are part of a series if specified
        $clauses[] = 'b.part_of_series IS NULL';
    }

    // Combine clauses into the SQL query
    if ($clauses) {
        $sql .= ' WHERE ' . implode(' AND ', $clauses);
    }

    // Add ordering by creation date and optional limit
    $sql .= ' ORDER BY b.created_at DESC';

    if ($limit !== false) {
        $sql .= ' LIMIT ?';
        $params[] = $limit;
        $types .= 'i'; // Integer type
    }

    // Prepare the SQL statement
    $stmt = mysqli_prepare($connection, $sql);
    if (!$stmt) {
        // Log error if statement preparation fails
        error_log("Query preparation failed: " . mysqli_error($connection));
        return false;
    }

    // Bind parameters to the statement if there are any
    if ($params) {
        mysqli_stmt_bind_param($stmt, $types, ...$params);
    }

    // Execute the statement and retrieve the result set
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt); // Close the statement

    // Return the result set or false if there was an error
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