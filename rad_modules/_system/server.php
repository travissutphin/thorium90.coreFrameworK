<?php
/* _SYSTEM.SERVER */
/*****************************************************************/

/**
  * List of function within SERVER
  * memory_status_Server()
  * wrapper_available_Server()
  * extension_available_Server()
  *	
*/
/*****************************************************************/



/**
  * @desc	Is wrapper available on this server
  * @param	ex. of $value = http, https, sqlsrv, 
  * @return $return (true or false)
*/
	function wrapper_available_Server($value)
	{
		$data = stream_get_wrappers();
		
		$return = (in_array($value, $data) ? true : false);
		
		return $return;
	}
/*****************************************************************/



/**
  * @desc	Is extension available on this server
  * @param	ex. of $value = openssl 
  * @return $return (true or false)
*/
	function extension_available_Server($value)
	{
		$return = (extension_loaded($value) ? true : false);
		
		return $return;
	}
/*****************************************************************/



/**
  * @desc	Calculate memory usage on server
  * @param	
  * @return $results (initial, final, peak)
*/
	function memory_status_Server()
	{
		$results = "Initial: ".memory_get_usage()." bytes <br />";
		/* prints
		Initial: 361400 bytes
		*/
		
		// let's use up some memory
		for ($i = 0; $i < 100000; $i++) {
			$array []= md5($i);
		}
		
		// let's remove half of the array
		for ($i = 0; $i < 100000; $i++) {
			unset($array[$i]);
		}
		
		$results.=  "Final: ".memory_get_usage()." bytes <br />";
		/* prints
		Final: 885912 bytes
		*/
		
		$resuls.= "Peak: ".memory_get_peak_usage()." bytes <br />";
		/* prints
		Peak: 13687072 bytes
		*/
		
		return $results;
	}

/*****************************************************************/
?>