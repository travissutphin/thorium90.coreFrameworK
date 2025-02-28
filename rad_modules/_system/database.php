<?php
/* _SYSTEM.DATABASE */
/*****************************************************************/

/**
  * @desc	create database connection for MySQL or MSSQL
  * @param	
  * @return $_SESSION['connection']
*/
	function connection_Database($db_type="MYSQL")
	{				
		if($db_type == "MYSQL")
		{
			$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE);

			if(!$connection)
  			{
				$_SESSION['error'] = mysqli_connect_error();
  				error_report_Helpers('Error Connecting to MySQL database - _system.database.database_connection',$sql,$result);
  			}

		}
		elseif($db_type == "MSSQL")
		{
			$connectionOptions = array("Database" => DB_DATABASE, 
    								   "UID" => DB_USER,
                    		       	   "PWD" => DB_PASSWORD,
									   "ReturnDatesAsStrings"=>true, // required for datetime to be displayed in php
									   "MultipleActiveResultSets" => true);				   	
			$connection = sqlsrv_connect(DB_SERVER, $connectionOptions);
		} 	  	
		
		$_SESSION['connection'] = $connection; // set database connection
		
		return $connection;
  	}
/*****************************************************************/



/**
  * @desc	creates a list of field names for each table/alias passed to it
  * @param	$table to get fields from / $alias to use for each table
  * @return define() with table name and all fields
*/
	function table_fields_Database($table,$alias)
	{
		// NEED TO ADD MSSQL version
		// SELECT *
		// FROM Northwind.INFORMATION_SCHEMA.COLUMNS
		// WHERE TABLE_NAME = N'Customers'

		$build_column = "";
		$sql = "SHOW COLUMNS FROM $table";
		
		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
		
		if (!$result) 
		{
			echo 'Could not run query: '.$sql;
			exit;
		}
		if ($_SESSION['NUM_ROWS']($result) > 0) {
			
			while ($row = $_SESSION['FETCH_ARRAY']($result)) 
			{
				foreach($row as $key => $value)
				{
					if($key == 'FIELD') // "FIELD" value holds the value we need
					{
						$build_column.= $alias.'.'.$value.', '; // concat the alias with the field name
					}
				}
			}
			$build_column = rtrim($build_column, ', ');// remove comma from end of string 
			$column_name = "COLUMNS_".strtoupper($table); // this will be the NAME of the define function
			define($column_name,$build_column);	// build the define() function
			$build_column = ""; // clear the columns for the next table
		}	
	}
/*****************************************************************/

/**
  * @desc	script that generates an XML file based on the structure of your blogs table. This script will query the blogs table, extract all relevant data, and create a well-formed XML document.
  * @param	
  * @return xml file
*/

	function create_sitemap_Database()
    {
try {		
		// Connect to the database
		$sql = ' SELECT * ';
		$sql.= ' FROM blogs ';
		
		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
		
		// Start building the XML document
		$xml = new DOMDocument('1.0', 'UTF-8');
		$xml->formatOutput = true;
		
		// Root element
		$root = $xml->createElement('blogs');
		$xml->appendChild($root);
		
		// Loop through the database records
		while($row = mysqli_fetch_array($display_post)) {
			$blog = $xml->createElement('blog');
			
			// Add child elements for each field
			$id = $xml->createElement('id', htmlspecialchars($row['id']));
			$title = $xml->createElement('title', htmlspecialchars($row['title']));
			$alias = $xml->createElement('alias', htmlspecialchars($row['alias']));
			$content_full = $xml->createElement('content_full', htmlspecialchars($row['content_full']));
			$content_intro = $xml->createElement('content_intro', htmlspecialchars($row['content_intro']));
			$meta_title = $xml->createElement('meta_title', htmlspecialchars($row['meta_title']));
			$meta_description = $xml->createElement('meta_description', htmlspecialchars($row['meta_description']));
			$part_of_series = $xml->createElement('part_of_series', htmlspecialchars($row['part_of_series']));
			$image_primary = $xml->createElement('image_primary', htmlspecialchars($row['image_primary']));
			$video_primary = $xml->createElement('video_primary', htmlspecialchars($row['video_primary']));
			$search_criteria = $xml->createElement('search_criteria', htmlspecialchars($row['search_criteria']));
			$knowledge_by_percentage = $xml->createElement('knowledge_by_percentage', htmlspecialchars($row['knowledge_by_percentage']));
			$created_by = $xml->createElement('created_by', htmlspecialchars($row['created_by']));
			$created_at = $xml->createElement('created_at', htmlspecialchars($row['created_at']));
			
			// Append all fields to the blog element
			$blog->appendChild($id);
			$blog->appendChild($title);
			$blog->appendChild($alias);
			$blog->appendChild($content_full);
			$blog->appendChild($content_intro);
			$blog->appendChild($meta_title);
			$blog->appendChild($meta_description);
			$blog->appendChild($part_of_series);
			$blog->appendChild($image_primary);
			$blog->appendChild($video_primary);
			$blog->appendChild($search_criteria);
			$blog->appendChild($knowledge_by_percentage);
			$blog->appendChild($created_by);
			$blog->appendChild($created_at);
			
			// Append blog element to the root
			$root->appendChild($blog);
		}
		
		// Save XML to a file
		$xml->save('sitemap.xml');
		echo "XML file created successfully.";
}

//catch exception
catch(Exception $e) {
  echo 'Message: ' .$e->getMessage(); exit;
}
	}
 
/*****************************************************************/
?>