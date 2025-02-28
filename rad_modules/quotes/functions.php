<?php
/* QUOTES.FUNCTIONS */
/*****************************************************************/

/** 
  * @desc	read data from table
  * @param	$id
  * @return complete query structure
*/
	function read_Quotes()
	{
		$sql = 'SELECT id, quote, author ';
		$sql.= 'FROM quotes ';	
		
		$sql.= ' ORDER BY RAND() ';
		
		$sql.= ' LIMIT 1,1 ';

		//$result = $_SESSION['QUERY']($_SESSION['connection'],$sql);
	  
		//return $result;
	}
/*****************************************************************/

/** 
  * @desc	read specific value
  * @param	$id
  * @return specific values of a record stored in an array
  * @to use	
  *		$array_data = read_values_($id);
  *		echo $array_data['id'];
*/
	function read_values_Quotes($id=FALSE)
	{
	  $sql = 'SELECT column FROM table ';	
	  if($id !== FALSE)
	  {
		$sql.= ' WHERE id = "'.$id.'" ';	  
	  }  
	  
	  $result = mysql_query($sql,database_connection()) or die (mysql_error());
	  
	  while($data = mysql_fetch_array($result))
	  {
		  $id = $data['id'];
	  }
	  return array('id' => $id);
	}
/*****************************************************************/



/** 
  * @desc	create an html select list
  * @param	$id(selected record) - $value(class, id, etc)
  * @return none - echo out list
*/
	function html_list_Quotes($id=FALSE,$values=FALSE)
	{
	  $sql = " SELECT * FROM table ";	
	  $sql.= ' ORDER BY column';
	  
	  $result = mysql_query($sql,database_connection()) or die (mysql_error());
	  
	  echo '<select name="id" "'.$values.'">';
	  while($row = mysql_fetch_array($result))
	  {
		if($row['id'] == $id){ $selected="selected"; }else{ $selected=""; }
		echo '<option value="'.$row['id'].'" '.$selected.'>'.$row['value'].'</option>';  
	  }
	  echo '</select>';
	}
/*****************************************************************/

?>