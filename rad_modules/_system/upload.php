<?php
/* _SYSTEM.UPLOAD */
/*****************************************************************/


/**
  * @desc	upload files
  * @param	
  * @return n/a
*/
	function file_Upload($name=FALSE,$move_to=FALSE,$max_size=FALSE)
	{
		
	    if ($_FILES[$name]["error"] > 0) {
	        echo "Error: " . $_FILES[$name]["error"] . "<br />";
	    } else {
	        
			/*	
	        echo "Upload: " . $_FILES[$name]["name"] . "<br />";
	        echo "Type: " . $_FILES[$name]["type"] . "<br />";
	        echo "Size: " . ($_FILES[$name]["size"] / 1024) . " Kb<br />";
	        echo "Stored in: " . $_FILES[$name]["tmp_name"];
	    	*/
	    	$file_size = ($_FILES[$name]["size"] / 1024);
			
	    	if($max_size != FALSE and $file_size > $max_size){
	    		// file is larger than max size allowed
	    		
			}else{
				// we will add the organizations unique id to the beginning of the file name 
		    	// then, use todays date/time as unix time stamp
		    	// then, the original file name and extension
				$date = date_create();
				$today = date_timestamp_get($date);
		    	$rename_file = $_SESSION['global_organization_id'].'_'.$today.'_'.$_FILES[$name]["name"];
		    	move_uploaded_file($_FILES[$name]["tmp_name"], $move_to."/".$rename_file);
			}
		}

		return $rename_file;
		
	}
/*****************************************************************/
?>