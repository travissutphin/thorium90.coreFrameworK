<?php
/* .FUNCTIONS */
/*****************************************************************/

/**
 * Get a page by its slug
 * 
 * @param PDO $pdo Database connection
 * @param string $slug Page slug to fetch
 * @return array|null Page data or null if not found
 */
function read_Pages($alias) {
     
	$conn = connection_Database();
    $query = "
        SELECT *
        FROM view_pages
        WHERE alias = ?
    ";
	
	$stmt = $conn->prepare($query);

    if (!$stmt) {
        die("Query preparation failed: " . $conn->error);
    }

	$stmt->bind_param('s', $alias);
    $stmt->execute();
    $result = $stmt->get_result();
    $page = [];
    while ($row = $result->fetch_assoc()) {
        $page[] = $row;
    }
    $stmt->close();
    $conn->close();
    return $page;
}
?>