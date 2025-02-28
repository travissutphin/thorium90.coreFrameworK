<?php
/* .FUNCTIONS */
/*****************************************************************/

/** 
  * @desc	create record
  * @param	
  * @return none - redirect will occure accordingly
*/
	function create_()
	{	  
	  $sql = "INSERT INTO table
			  (column) 
			  VALUES ('value') " ;
	  
	  $result = mysql_query($sql,database_connection()) or die (mysql_error());	
	}
/*****************************************************************/

/** 
  * @desc	read data from table
  * @param	$id
  * @return complete query structure
*/
	function read_($id=FALSE)
	{
	  $sql = 'SELECT column FROM table WHERE 0=0 ';	
	  if($id !== FALSE)
	  {
		$sql.= ' AND id = "'.$id.'" ';	  
	  }  
	  
	  $sql.= ' ORDER BY fields ';
	  
	  $result = mysql_query($sql,database_connection()) or die (mysql_error());
	  
	  return $result;
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
	function read_values_($id=FALSE)
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
  * @desc	update
  * @param	$id (specific record)
  * @return none
*/
	function update_()
	{
	  $sql = "UPDATE table
			  SET 
			  column = '".$_POST['value']."' ,
			  column = '".$_POST['value']."'
			  WHERE id = '".$_POST['id']."'
			 ";
			 
	  $result = mysql_query($sql,database_connection()) or die (mysql_error());
	}
/*****************************************************************/

/** 
  * @desc	delete
  * @param	$id
  * @return none
*/
	function delete_($id="")
	{
	  if($id != "")
	  {
		$sql = 'DELETE FROM table
				WHERE id = "'.$id.'" ';
					  
		$result = mysql_query($sql,database_connection()) or die (mysql_error());
	  }
	}
/*****************************************************************/

/** 
  * @desc	create an html select list
  * @param	$id(selected record) - $value(class, id, etc)
  * @return none - echo out list
*/
	function html_list_($id=FALSE,$values=FALSE)
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