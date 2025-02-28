<?php
/* .FUNCTIONS */
/*****************************************************************/
//$_SESSION['QUERY']($_SESSION['connection']

// Retrieve all store items
function get_all_store_items() {
    $conn = connection_Database();
    $query = "SELECT * FROM store WHERE deleted_at IS NULL";
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

    //$stmt->close();
    //$conn->close();

    return $items;
}

// Retrieve a specific store item
function get_store_item_details($alias) {
    $conn = connection_Database();
    $query = "
        SELECT s.*
        FROM store s
        WHERE s.alias = ? AND s.deleted_at IS NULL
    ";

    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die("Query preparation failed: " . $conn->error);
    }

	$stmt->bind_param('s', $alias);
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


// Retrieve a store images
function get_store_images($id) {
    $conn = connection_Database();
    $query = "
        SELECT si.*
        FROM store_images si
        WHERE si.store_id = ?
    ";
	
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die("Query preparation failed: " . $conn->error);
    }

    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    $stmt->close();
    $conn->close();

    return $result;
}


// Query to count images for the specific store_id
function count_store_images($id) {
	$conn = connection_Database();
	$query = "
		SELECT COUNT(*) AS image_count 
		FROM store_images 
		WHERE store_id = ?
	";
	
	$stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Query preparation failed: " . $conn->error);
    }
	
	$stmt->bind_param("i", $id);
	$stmt->execute();
	$result = $stmt->get_result();

	// Fetch the count
    $row = $result->fetch_assoc();
    $image_count = $row['image_count'];
	
	// Close connection
	$stmt->close();
    $conn->close();
	
	return $image_count;
}


// Retrieve all store items in a specific category
function get_store_items_by_category($category_id) {
    $conn = connection_Database();
    $query = "
        SELECT s.* 
        FROM store s
        INNER JOIN store_x_categories sc ON s.id = sc.store_id
        WHERE sc.category_id = ? AND s.deleted_at IS NULL
    ";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die("Query preparation failed: " . $conn->error);
    }

    $stmt->bind_param('i', $category_id);
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
function determine_alias_type($alias) {
    $conn = connection_Database();

    // Check if alias exists in the store table (product)
    $query_product = "SELECT COUNT(*) as count FROM store WHERE alias = ? AND deleted_at IS NULL";
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
        return 'product';
    }

    // Check if alias exists in the store_categories table (category)
    $query_category = "SELECT COUNT(*) as count FROM store_categories WHERE alias = ?";
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


?>