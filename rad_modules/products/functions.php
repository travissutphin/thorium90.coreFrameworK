<?php
/* PRODUCTS.FUNCTIONS */
/*****************************************************************/

/** 
  * @desc	read categories
  * @param	
  * @return none - redirect will occure accordingly
*/
function read_product_categories($id = null)
{
	$categoryId = isset($id) ? intval($id) : null;

	// Query to retrieve product categories
	if ($id) {
		// Retrieve a specific category
		$sql = "SELECT * FROM product_categories WHERE id = ?";
		$stmt = mysqli_prepare($_SESSION['connection'], $sql);
		mysqli_stmt_bind_param($stmt, "i", $categoryId);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
	} else {
		// Retrieve all categories
		$sql = "SELECT * FROM product_categories";
		$result = mysqli_query($_SESSION['connection'], $sql);
	}
	
	return $result;
	
	// Close the connection
    if (isset($stmt)) {
        mysqli_stmt_close($stmt);
    }
    mysqli_close($_SESSION['connection']);
}
/********************************************************/



/** 
  * @desc	read products in category
  * @param	
  * @return none - redirect will occure accordingly
*/
function read_product($alias =  null)
{
	$alias = isset($alias) ? strval($alias) : null;

	if (!empty($alias)) {
		// Query to retrieve all products in a category based on alias
		$sql = "
			SELECT 
				p.id AS product_id,
				p.title AS product_title,
				p.alias AS product_alias,
				p.tagline AS product_tagline,
				p.description AS product_description,
				p.primary_image AS product_primary_image,
				p.second_image AS product_second_image,
				p.third_image AS product_third_image,
				p.cost AS product_cost,
				p.availability AS product_availability,
				p.created_at AS product_created_at,
				p.updated_at AS product_updated_at,
				pc.id AS category_id,
				pc.alias AS category_alias
			FROM products p
			INNER JOIN products_x_categories pxc ON p.id = pxc.product_id
			INNER JOIN product_categories pc ON pxc.category_id = pc.id
			WHERE pc.alias = ?" ;

		$stmt = mysqli_prepare($_SESSION['connection'], $sql);
		mysqli_stmt_bind_param($stmt, "s", $alias);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
	} else {
		// Retrieve all categories
		$sql = "SELECT * FROM products";
		$result = mysqli_query($_SESSION['connection'], $sql);
	}
	
	return $result;
	
	// Close the connection
    if (isset($stmt)) {
        mysqli_stmt_close($stmt);
    }
    mysqli_close($_SESSION['connection']);
}

?>