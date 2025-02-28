<?php
/* REGISTER.FUNCTIONS */
/*****************************************************************/

/** 
  * @desc	verify email address is unique to the databse
  * @param	$email
  * @return $num_rows
*/
	function unique_email_Register($email)
	{
	  $sql = 'SELECT id, email, name_first, name_last, password, role_id FROM system_tbl_users ';	
	  $sql.= ' WHERE email = "'.$email.'" ';	 
	
	  $result = mysql_query($sql,database_connection()) or die (mysql_error());
	  
	  $num_rows = mysql_num_rows($result);
	  
	  return $num_rows;  	
	}
/*****************************************************************/

?>