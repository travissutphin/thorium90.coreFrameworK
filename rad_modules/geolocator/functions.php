<?php
/* GEOLOCATOR.FUNCTIONS */
/*****************************************************************/

/** 
  * @desc	create record
  * @param	all posted vars
  * @return none - redirect will occur accordingly
*/
	function create_Gelocator()
	{	  
		$data_columns = "";
		$data_values = "";
		
		foreach ($_POST as $key => $value) 
		{
			// x_ = add to posted vars you don't want included here that are not listed in $_SESSION['ignore']
			if(!in_array($key,$_SESSION['ignore']) and strpos($key, 'x_') === FALSE) // $_SESSION['ignore'] = _system/config.php
			{			
				$data_columns.= $key.",";
				$data_values.= "'$value',";
			}
		}
		$data_columns = rtrim($data_columns, ','); // remove comma from end of string
		$data_values = rtrim($data_values, ','); // remove comma from end of string
		
		$sql = "INSERT INTO geolocator
			  ($data_columns) 
			  VALUES ($data_values) " ;
		
		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
		
		// error reporting 
		if($result === false) 
		{ error_report_Helpers('Error - create_Gelocator()',$sql,$result); }
		
		$message = 'created';
		
		return $message;		  
	}
/*****************************************************************/


/** 
  * @desc	read data from table
  * @param	$id
  * @return complete query structure
*/
	function read_Gelocator($geolocator_id=FALSE,$state=FALSE,$city=FALSE,$zipcode=FALSE,$longitude=FALSE,$latitude=FALSE,$order_by=FALSE)
	{
		$sql = ' SELECT '.COLUMNS_GEOLOCATOR.' FROM geolocator ge ';
		$sql.= " WHERE 0=0 ";
		
		if($geolocator_id != NULL)
		{ $sql.= " AND ge.GEOLOCATOR_ID = '$geolocator_id' "; }

		if($state != NULL)
		{ $sql.= " AND ge.GE_STATE = '$state' "; }

		if($city != NULL)
		{ $sql.= " AND ge.GE_CITY = '$city' "; }

		if($zipcode != NULL)
		{ $sql.= " AND ge.GE_ZIPECODE = '$zipcode' "; }

		$sql.= " AND ge.DELETED_AT IS NULL ";
		$sql.= " AND ge.GE_COUNTRY = 'USA' ";
		
		if($order_by != NULL)
		{ $sql.= " ORDER BY '$order_by' "; }
		
		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
		
		// error reporting 
		if($result === false) 
		{ error_report_Helpers('Error - read_Gelocator()',$sql,$result); }
		
		return $result;
	}
/*****************************************************************/


/** 
  * @desc	read table, create array of values
  * @param	$id
  * @return specific values of a record stored in an array
  * @to use	
  *			$array_data = read_values_($id);
  *			echo $array_data['id'];
*/
	function read_values_Gelocator($geolocator_id=FALSE,$state=FALSE,$city=FALSE,$zipcode=FALSE,$longitude=FALSE,$latitude=FALSE,$order_by=FALSE)
	{
		$sql = ' SELECT '.COLUMNS_GEOLOCATOR.' FROM geolocator ge ';
		$sql.= " WHERE 0=0 ";
		
		if($geolocator_id != NULL)
		{ $sql.= " AND ge.GEOLOCATOR_ID = '$geolocator_id' "; }

		if($state != NULL)
		{ $sql.= " AND ge.GE_STATE = '$state' "; }

		if($city != NULL)
		{ $sql.= " AND ge.GE_CITY = '$city' "; }

		if($zipcode != NULL)
		{ $sql.= " AND ge.GE_ZIPECODE = '$zipcode' "; }

		$sql.= " AND ge.DELETED_AT IS NULL ";
		$sql.= " AND ge.GE_COUNTRY = 'USA' ";
		
		if($order_by != NULL)
		{ $sql.= " ORDER BY '$order_by' "; }
		
		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
		
		// error reporting 
		if($result === false) 
		{ error_report_Helpers('Error - read_values_Users',$sql,$result); }
		
		// loop over row and create vars
		// create array of values from this record
		$array = array();
		$data = $_SESSION['FETCH_ARRAY']($result);
		
		if($data != NULL) {
			foreach($data as $key => $value) // creates assocative array
			{
				if(!is_numeric($key))
				{ $array = array_merge($array, array(strtolower($key) => $value)); }
			}  
		}
		return $array;
	}
/*****************************************************************/


/** 
  * @desc	update
  * @param	$id (specific record)
  * @return none
*/
	function update_Gelocator()
	{
		$message = "updated"; // _system/message_center.php
		
		$data_update = "";
		foreach ($_POST as $key => $value) 
		{
			// x_ = add to posted vars you don't want included here that are not listed in $_SESSION['ignore']
			if(!in_array($key,$_SESSION['ignore']) and strpos($key, 'x_') === false) // $_SESSION['ignore'] = _system/config.php
			{
				$value = cleanInput_Security($value);
				$data_update.= $key." = '".$value."',";
			}
		}
		
		$data_update = rtrim($data_update, ','); // remove comma from end of string
		
		$sql = "UPDATE geolocator
				SET ".$data_update."
				WHERE GEOLOCATOR_ID = '$_POST[GEOLOCATOR_ID]'
			   ";
		
		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
			
		// error reporting 
		if($result === false) 
		{ error_report_Helpers('Error - update_Geolocator()',$sql); }
		
		// clear values as session vars
		clear_postVars_to_sessionVars_Helpers();
				
		return $message;		
	}
/*****************************************************************/



/** 
  * @desc	delete
  * @param	$id
  * @return none
*/
	function delete_Gelocator($id=FALSE)
	{
		if($id !== FALSE)
		{
			$message = "deleted";
			$today = date("Y-m-d");
			$sql = "UPDATE geolocator
					SET DELETED_AT = '$today'
					WHERE GEOLOCATOR_ID = '$id' ";

			$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
			
			// error reporting 
			if($result === false) 
			{ error_report_Helpers('Error Message - delete_Geolocator',$sql,$result); }
			
			return $message;
		}
	}
/*****************************************************************/


/** 
  * @desc	create an html select list
  * @param	$id(selected record) - $value(class, id, etc)
  * @return none - echo out list
*/
	function html_list_State_Geolocator($state=FALSE,$values=FALSE,$select_form_name=FALSE,$default_caption=FALSE)
	{
	  $sql = ' SELECT DISTINCT(GE_STATE) FROM geolocator ge ';
	  //$sql.= " WHERE ge.DELETED_AT IS NULL ";
	  $sql.= " WHERE ge.GE_COUNTRY = 'USA' ";
	  $sql.= ' ORDER BY GE_STATE ';
	  
	  $result = $_SESSION['QUERY']($_SESSION['connection'],$sql);

	  // error reporting 
	  if($result === false) 
	  {	error_report_Helpers('Error - html_list_State_Geolocator()',$sql,$result); }
	  
?>
	<select name="<?php echo $select_form_name; ?>" class="form-control" onchange="loadCityData(this)" >
<?php
	  
	  if($default_caption == FALSE){
	  	echo '<option value="">Select a State</option>';
	  }else{
	  	echo '<option value="">Change State / City / Zip</option>';
	  }
	  
	  while($row = $_SESSION['FETCH_ARRAY']($result))
	  {
		if($row['GE_STATE'] == $state){ $selected="selected"; }else{ $selected=""; }
		echo '<option value="'.$row['GE_STATE'].'" '.$selected.'>'.$row['GE_STATE'].'</option>';  
	  }
	  echo '</select>';
	}
/*****************************************************************/


/** 
  * @desc	create an html select list
  * @param	$id(selected record) - $value(class, id, etc)
  * @return none - echo out list
*/
	function html_list_City_Geolocator($id=FALSE,$values=FALSE,$state=FALSE,$select_form_name=FALSE)
	{
	  $sql = ' SELECT DISTINCT(GE_CITY) FROM geolocator ge ';
	  $sql.= " WHERE ge.GE_STATE = '$state' ";
	  $sql.= " AND ge.GE_COUNTRY = 'USA' ";
	  $sql.= ' ORDER BY ge.GE_CITY ';
	  
	  $result = $_SESSION['QUERY']($_SESSION['connection'],$sql);

	  // error reporting 
	  if($result === false) 
	  {	error_report_Helpers('Error - html_list_City_Geolocator()',$sql,$result); }
?> 
	  <select name="<?php echo $select_form_name; ?>" class="form-control" onchange="loadZipData(this)" >
<?php
	  //echo '<select name="GE_CITY" "'.$values.'" class="form-control" onchange="loadZipData(this)" >';
	  echo '<option value="">Select a City</option>';
	  while($row = $_SESSION['FETCH_ARRAY']($result))
	  {
		if($row['GE_CITY'] == $id){ $selected="selected"; }else{ $selected=""; }
		echo '<option value="'.$row['GE_CITY'].'" '.$selected.'>'.$row['GE_CITY'].'</option>';  
	  }
	  echo '</select>';
	}
/*****************************************************************/


/** 
  * @desc	create an html select list
  * @param	$id(selected record) - $value(class, id, etc)
  * @return none - echo out list
*/
	function html_list_Zip_Code_Geolocator($id=FALSE,$values=FALSE,$state=FALSE,$city=FALSE,$select_form_name=FALSE)
	{
	  $sql = ' SELECT DISTINCT(GE_ZIPCODE) FROM geolocator ge ';
	  //$sql.= " WHERE ge.GE_STATE = '$state' ";
	  $sql.= " WHERE ge.GE_CITY = '$city' ";
	  $sql.= " AND ge.GE_COUNTRY = 'USA' ";
	  $sql.= ' ORDER BY ge.GE_ZIPCODE ';
	  
	  $result = $_SESSION['QUERY']($_SESSION['connection'],$sql);

	  // error reporting 
	  if($result === false) 
	  {	error_report_Helpers('Error - html_list_Zip_Code_Geolocator()',$sql,$result); }
?>
	<select name="<?php echo $select_form_name; ?>" class="form-control">
<?php	  

	  //echo '<select name="GE_ZIPCODE" "'.$values.'" class="form-control"  >';
	  echo '<option value="">Select a Zip Code</option>';
	  while($row = $_SESSION['FETCH_ARRAY']($result))
	  {
		if($row['GE_ZIPCODE'] == $id){ $selected="selected"; }else{ $selected=""; }
		echo '<option value="'.$row['GE_ZIPCODE'].'" '.$selected.'>'.$row['GE_ZIPCODE'].'</option>';  
	  }
	  echo '</select>';
	}
/*****************************************************************/

?>