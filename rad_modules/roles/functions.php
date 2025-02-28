<?php
/* ROLES.FUNCTIONS */
/*****************************************************************/

/** 
  * @desc	create record
  * @param	$_POST
  * @return none - redirect done in function
*/
	function create_Roles()
	{	  
	  $sql = "INSERT INTO system_tbl_roles
			  (name) 
			  VALUES ('$_POST[name]') " ;
	
	  $result = mysqli_query(database_connection(),$sql) or die (mysqli_error());
	}

#################################################################################

function read_Roles($id=FALSE)
{
  $sql = 'SELECT id, name FROM system_tbl_roles ';	
  if($id !== FALSE)
  {
	$sql.= ' WHERE id = "'.$id.'" ';	  
  }  
  
  $sql.= ' ORDER BY name ';
  
  $result = mysqli_query(database_connection(),$sql) or die (mysqli_error());
  
  return $result;
}

#################################################################################

function read_values_Roles($id=FALSE)
{
  $sql = 'SELECT id, name FROM system_tbl_roles ';	
  if($id !== FALSE)
  {
	$sql.= ' WHERE id = "'.$id.'" ';	  
  }  
  
  $result = mysqli_query(database_connection(),$sql) or die (mysqli_error());
  
  while($data = mysqli_fetch_array($result))
  {
	  $id = $data['id'];
	  $name = $data['name'];
  }
  
  return array('id' => $id, 'name' => $name);  
}

#################################################################################

function update_Roles()
{
  $sql = "UPDATE system_tbl_roles
		  SET 
		  name = '".$_POST['name']."'
		  WHERE id = '".$_POST['id']."'
         ";
		 
  $result = mysqli_query(database_connection(),$sql) or die (mysqli_error());
}

#################################################################################

function delete_Roles($id="")
{
  if($id != "")
  {
	$sql = 'DELETE FROM system_tbl_roles
			WHERE id = "'.$id.'" ';
				  
	$result = mysqli_query(database_connection(),$sql) or die (mysqli_error());
  }
}

#################################################################################

function html_list_Roles($id=FALSE,$values=FALSE)
{
  $sql = " SELECT * FROM system_tbl_roles ";	
  $sql.= ' ORDER BY name';
  
  $result = mysqli_query(database_connection(),$sql) or die (mysqli_error());
  
  echo '<select name="role_id" "'.$values.'">';
  while($row = mysqli_fetch_array($result))
  {
	if($row['id'] == $id){ $selected="selected"; }else{ $selected=""; }
	echo '<option value="'.$row['id'].'" '.$selected.'>'.$row['name'].'</option>';  
  }
  echo '</select>';
}

#################################################################################

?>