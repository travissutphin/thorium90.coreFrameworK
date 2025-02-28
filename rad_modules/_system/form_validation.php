<?php
/* _SYSTEM.FORM_VALIDATION */
/*****************************************************************/

/**
  * social_security_number_Form_Validation()
  *	us_zip_codes_Form_Validation()
  * 
*/



/**
  * @desc	validate social security numbers
  * @param	
  * @return 
  * @notes	Not allowed accoring to SS Web Site
 * 			Numbers with all zeros in any digit group (000-##-####, ###-00-####, ###-##-0000)
			Numbers with 666 or 900-999 in the first digit group
			Numbers from 987-65-4320 to 987-65-4329 are reserved for use in advertisements 
*/
	function social_security_number_Form_Validation($value) 
	{
        $value=str_replace(" ","",trim($value));
        return preg_match("#^(?!(000|666|9))\d{3}-(?!00)\d{2}-(?!0000)\d{4}$#",$value);
    }
/*****************************************************************/


/**
  * @desc	validate US zip codes
  * @param	
  * @return 
  * @notes	
*/
	function us_zip_codes_Form_Validation($value)
	{
		$value=str_replace(" ","",trim($value));
        return preg_match_all("#\b[0-9]{5}(?:-[0-9]{4})?\b#",$value);	
	}
/*****************************************************************/

/**
  * @desc	validate format type (specifically for Data Questions)
  * @param	$_POST
  * @return none
*/
	function value_format_range_Form_Validation($value=FALSE,$format=FALSE,$range=FALSE)
	{
		switch ($format) {
    		case 'Percentage':
				$range = range(0, 100);
				if(!in_array($value, $range)){
					
				}
			case 'Whole Number':
				if(!is_int($value)){
						
				}	
		}
	}
/*****************************************************************/	
?>