<?php
/* _SYSTEM.HTML_SELECT_LISTS */
/*****************************************************************/

/**
  * @desc	html select list User Status 
  * @param	
  * @return none
*/
	function users_status_HTML_Select_Lists($value=FALSE)
	{
		if($value == '1'){ $selected_yes="selected"; }else{ $selected_yes=""; }
		if($value == '0'){ $selected_no="selected"; }else{ $selected_no=""; }
				
		echo '<select name="US_STATUS" class="form-control">';
		echo '<option value="1" '.$selected_yes.'>Active</option>'; 
		echo '<option value="0" '.$selected_no.'>Not Active</option>';  
		echo '</select>';		
	}
/*****************************************************************/

/**
  * @desc	html select list Unit Status 
  * @param	
  * @return none
*/
	function unit_status_HTML_Select_Lists($value=FALSE)
	{
		if($value == '1'){ $selected_pending="selected"; }else{ $selected_pending=""; }
		if($value == '2'){ $selected_active="selected"; }else{ $selected_active=""; }
		if($value == '3'){ $selected_inactive="selected"; }else{ $selected_inactive=""; }
		if($value == '4'){ $selected_archived="selected"; }else{ $selected_archived=""; }
		
		echo '<select name="STATUS_FK" class="form-control">';
		echo '<option value="1" '.$selected_pending.'>Pending</option>'; 
		echo '<option value="2" '.$selected_active.'>Active</option>'; 
		echo '<option value="3" '.$selected_inactive.'>Inactive</option>';
		echo '<option value="4" '.$selected_archived.'>Archived</option>';   
		echo '</select>';		
	}
/*****************************************************************/


/**
  * @desc	html select list AM / PM 
  * @param	
  * @return none
*/
	function html_list_AM_PM_HTML_Select_Lists($name='AMPM',$value='AM',$class='form-control')
	{
		if($value == 'AM'){ $selected_am="selected"; }else{ $selected_am=""; }
		if($value == 'PM'){ $selected_pm="selected"; }else{ $selected_pm=""; }
		
		echo "<select name='$name' class='$class'>";
		echo '<option value="AM" '.$selected_am.'>AM</option>'; 
		echo '<option value="PM" '.$selected_pm.'>PM</option>';  
		echo '</select>';		
	}
/*****************************************************************/

/**
  * @desc	html select list States 
  * @param	
  * @return none
*/
	function states_HTML_Select_Lists($value=FALSE)
	{
		$us_states = array('AL', 'AK', 'AS', 'AZ', 'AR', 'CA', 'CO', 'CT', 'DE', 'DC', 'FL', 'GA', 'HI', 'ID', 'IL', 'IN', 'IA', 'KS', 'KY', 'LA', 'ME', 'MD', 'MA', 'MI', 'MN', 'MS', 'MO', 'MT', 'NE', 'NV', 'NH', 'NJ', 'NM', 'NY', 'NC', 'ND', 'OH', 'OK', 'OR', 'PA', 'RI', 'SC', 'SD', 'TN', 'TX', 'UT', 'VT', 'VI', 'VA', 'WA', 'WV', 'WI', 'WY');

		echo '<select name="STATE" class="form-control">';
		foreach($us_states as $state) {
		{
			if($state == $value){ $selected="selected"; }else{ $selected=""; }
				echo '<option value="'.$state.'" '.$selected.'>'.$state.'</option>';
			}
		}
	  	echo '</select>';
	}
/*****************************************************************/


?>