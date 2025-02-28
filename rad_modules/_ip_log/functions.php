<?php
/* IP_LOG.FUNCTIONS */
/*****************************************************************/

/** 
  * @desc	
  * @param	
  * @return none 
*/
	function iptocountry($ip) {
    
		$numbers = preg_split( "/\./", $ip);
		include("assets/ip_files/".$numbers[0].".php");
		$code=($numbers[0] * 16777216) + ($numbers[1] * 65536) + ($numbers[2] * 256) + ($numbers[3]);
		
		foreach($ranges as $key => $value){
			if($key<=$code){
				if($ranges[$key][0]>=$code){$two_letter_country_code=$ranges[$key][1];break;}
			}
		}
		
	if ($two_letter_country_code==""){$two_letter_country_code="unkown";}
    return $two_letter_country_code;

	}
/*****************************************************************/


/** 
  * @desc	create record
  * @param	
  * @return none - redirect will occur accordingly
*/
	function create_IP_Log($ip,$organization_fk,$logged_at,$user_fk=FALSE)
	{
		if($user_fk == FALSE){
			$user_fk = NULL;
		}
		$today = date("Y-m-d H:i:s");	  		
		$sql = "INSERT INTO ip_log
			  (IP_ADDRESS,ORGANIZATION_FK,CREATED_AT,LOGGED_AT,USER_FK) 
			  VALUES ('$ip',$organization_fk,'$today','$logged_at',$user_fk) " ;

		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
		
		// error reporting 
		if($result === false) 
		{ error_report_Helpers('Error - create_IP_Log()',$sql,$result); }
		
		$message = 'created';
		
		return $message;		  
	}
/*****************************************************************/


/** 
  * @desc	read data from table
  * @param	$id
  * @return complete query structure
*/
	function read_IP_Log($ip_log_id=FALSE,$ip_address=FALSE,$organization_fk=FALSE)
	{
		$sql = ' SELECT '.COLUMNS_IP_LOG.' FROM ip_log il ';		
		$sql.= " WHERE 0=0 ";
				
		if($ip_address != FALSE){
			$sql.= " AND il.IP_ADDRESS = '$ip_address' ";
		}
		
		if($organization_fk != FALSE){
			$sql.= " AND il.ORGANIZATION_FK = '$organization_fk' ";
		}

		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
		
		// error reporting 
		if($result === false) 
		{ error_report_Helpers('Error - read_IP_Log()',$sql,$result); }
		
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
		function read_values_IP_Log($ip_log_id=FALSE,$ip_address=FALSE,$organization_fk=FALSE)
	{
		$sql = ' SELECT '.COLUMNS_IP_LOG.' FROM ip_log il ';		
		$sql.= " WHERE 0=0 ";
				
		if($ip_address != FALSE){
			$sql.= " AND il.IP_ADDRESS = '$ip_address' ";
		}
		
		if($organization_fk != FALSE){
			$sql.= " AND il.ORGANIZATION_FK = '$organization_fk' ";
		}

		$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
		
		// error reporting 
		if($result === false) 
		{ error_report_Helpers('Error - read_values_Schedule_Sequence',$sql,$result); }
		
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
	function update_IP_Log()
	{
		
	}
/*****************************************************************/



/** 
  * @desc	delete
  * @param	$id
  * @return none
*/
	function delete_IP_Log($ip_log_id=FALSE,$ip_address=FALSE,$organization_id=FALSE)
	{
		if($organization_id !== FALSE and $ip_address !== FALSE)
		{
			$sql = "DELETE FROM ip_log
					WHERE ORGANIZATION_FK = '$organization_id' 
					  AND IP_ADDRESS = '$ip_address'
				   ";
		
			$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
			
			// error reporting 
			if($result === false) 
			{ error_report_Helpers('Error - delete_IP_Log',$sql,$result); }
			
			$message = "deleted";
			
		}else{
			$message = "not_able_to_delete";
		}
		return $message;
	}
/*****************************************************************/

?>