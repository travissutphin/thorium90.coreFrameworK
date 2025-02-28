<?php
/**
 * Function to read a blog's details by its alias and return a specific output array
 * @param string $alias -> The $alias of the blog to retrieve | $output -> "assoc_array" (multiple records) "array" (single record)
 * @return array|false Returns an associative array with specific fields or false if not found
 */
function read_Blog($alias=FALSE,$output="assoc_array") {
    
	// Establish database connection
	$conn = connection_Database();
	if (!$conn) {
        error_log("Database connection failed. [blog.functions.php/read_Blogs()]");
        return false;
    }
	
	// Prepare the SQL query to select from the view
	if($alias == FALSE){
		// View all blog posts
		$sql = "SELECT * FROM view_blogs_with_categories_tags";
	}else{
		// View blog post by alias
		$sql = "SELECT * FROM view_blog_details_by_alias WHERE alias = ? ";
	}

	$stmt = mysqli_prepare($conn, $sql);
	if (!$stmt) {
		   error_log("Query preparation failed: [blog.functions.php/read_Blogs()] " . mysqli_error($conn));
		   return FALSE;
	}

	if($alias != FALSE){
		// Bind the alias parameter to the query only if $alias is passed
		mysqli_stmt_bind_param($stmt, "s", $alias);
	}

	// Execute the query
    if (!mysqli_stmt_execute($stmt)) {
        error_log("Query execution failed: [blog.functions.php/read_Blogs()] " . mysqli_stmt_error($stmt));
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return false;
    }

	// Get the result set
    $result = mysqli_stmt_get_result($stmt);
    if (!$result) {
        error_log("Failed to get result set: [blog.functions.php/read_Blogs()] " . mysqli_error($conn));
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return false;
    }

	// Fetch all rows as an array of associative arrays
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

	// Close the statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

	// If no data was found, return false
    if (empty($data)) {
        return false;
    }

	if($output == "assoc_array"){
		// Map the fields to the desired output array
		$output = [
			'title' => $data['title'] ?? '', // Use empty string as default if field is missing
			'alias' => $data['alias'] ?? '',
			'content_intro' => $data['content_intro'] ?? '',
			'image_primary' => $data['image_primary'] ?? '',
			'meta_title' => $data['meta_title'] ?? '',
			'meta_description' => $data['meta_description'] ?? '',
			'meta_created_at' => $data['created_at'] ?? ''
		];
		
		// Return the blog data as an associative array
		return $output;
	}else{
		// Return the blog data as an array
		return $data;
	}
}



function read_categories_Blog() {

	$conn = connection_Database();
    $query = "SELECT * FROM view_blog_categories";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die("Query preparation failed: " . $conn->error);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $items = [];

    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }

    $stmt->close();
    $conn->close();

    return $items;
}	



// Function to determine if the alias belongs to a category or a product
function determine_alias_type_Blog($alias) {
    $conn = connection_Database();

    // Check if alias exists in the store table (product)
    $query_product = "SELECT COUNT(*) as count FROM blogs WHERE alias = ? AND deleted_at IS NULL";
    $stmt_product = $conn->prepare($query_product);

    if (!$stmt_product) {
        die("Query preparation failed for product: " . $conn->error);
    }

    $stmt_product->bind_param('s', $alias);
    $stmt_product->execute();
    $result_product = $stmt_product->get_result();
    $row_product = $result_product->fetch_assoc();

    if ($row_product['count'] > 0) {
        $stmt_product->close();
        $conn->close();
        return 'post';
    }

    // Check if alias exists in the store_categories table (category)
    $query_category = "SELECT COUNT(*) as count FROM blog_categories WHERE alias = ?";
    $stmt_category = $conn->prepare($query_category);

    if (!$stmt_category) {
        die("Query preparation failed for category: " . $conn->error);
    }

    $stmt_category->bind_param('s', $alias);
    $stmt_category->execute();
    $result_category = $stmt_category->get_result();
    $row_category = $result_category->fetch_assoc();

    if ($row_category['count'] > 0) {
        $stmt_category->close();
        $conn->close();
        return 'category';
    }

    // If not found in either table
    $stmt_category->close();
    $conn->close();
    return 'unknown';
}	
	

/*
CREATE VIEW vw_blogs_with_categories_tags AS
SELECT 
    b.id, 
    b.title, 
    b.alias AS blog_alias,
    b.content_full,
    b.content_intro, 
    b.meta_title,
    b.meta_description,
    b.meta_keywords,
    b.image_primary,
    b.video_primary,
    b.part_of_series,
    b.knowledge_by_percentage,
    b.search_criteria,
    b.created_by,
    b.created_at,
    b.updated_at,
    b.deleted_at,
    bc.category,
    bc.alias AS category_alias,
    bc.primary_image,
    bc.featured,
    bt.tag,
    bt.alias AS tag_alias,
    GROUP_CONCAT(DISTINCT bc.category) AS categories,
    GROUP_CONCAT(DISTINCT bt.tag) AS tags
FROM blogs b
LEFT JOIN blog_x_categories bxc ON b.id = bxc.blog_fk
LEFT JOIN blog_categories bc ON bxc.blog_category_fk = bc.id
LEFT JOIN blog_x_tags bxt ON b.id = bxt.blog_fk
LEFT JOIN blog_tags bt ON bxt.blog_tag_fk = bt.id
GROUP BY b.id;


CREATE VIEW vw_blog_details_by_alias AS
SELECT 
    b.id, 
    b.title, 
    b.alias,
    b.content_full,
    b.content_intro, 
    b.meta_title,
    b.meta_description,
    b.meta_keywords,
    b.image_primary,
    b.video_primary,
    b.part_of_series,
    b.knowledge_by_percentage,
    b.search_criteria,
    b.created_by,
    b.created_at,
    b.updated_at,
    b.deleted_at,
    bc.primary_image,
    bc.featured,
    GROUP_CONCAT(DISTINCT bc.category) AS categories,
    GROUP_CONCAT(DISTINCT bt.tag) AS tags,
    GROUP_CONCAT(DISTINCT bi.image) AS images,
    GROUP_CONCAT(DISTINCT bi.alt) AS image_alts
FROM blogs b
LEFT JOIN blog_x_categories bxc ON b.id = bxc.blog_fk
LEFT JOIN blog_categories bc ON bxc.blog_category_fk = bc.id
LEFT JOIN blog_x_tags bxt ON b.id = bxt.blog_fk
LEFT JOIN blog_tags bt ON bxt.blog_tag_fk = bt.id
LEFT JOIN blog_images bi ON b.id = bi.blog_fk
GROUP BY b.id;




CREATE VIEW view_blog_categories AS
SELECT 
    bc.id, 
    bc.category, 
    bc.alias,
    bc.primary_image,
    bc.featured
FROM blog_categories bc
*/