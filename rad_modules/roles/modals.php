<?php
/* ROLES.MODALS */
/*****************************************************************/

/** 
  * @desc	display create
  * @param	
  * @return 
*/
?>
    <form name="manage" action="view.php" method="post">
    <div class="modal hide fade" id="create">
     <div class="modal-header">
        <button class="close" data-dismiss="modal">×</button>
        <h3>Add User</h3>
      </div>
        <div class="modal-body">
            Name:<br />
            <input name="name" type="text" class="input-large" value="" />
            <br />
        </div>
		<div class="modal-footer">
          <button name="create" class="btn btn-success pull-right">Save</button>
          <button name="cancel" class="btn pull-right" data-dismiss="modal">Cancel</button>
        </div>
    </div>
    </form>
<?php
/*****************************************************************/

/** 
  * @desc	display update
  * @param	
  * @return 
*/
?>

<?php //$records_all = read_role(); ?>
<?php //while ($row = mysql_fetch_array($records_all)){ ?>
  <form name="manage" action="view.php" method="post">
  <div class="modal hide fade" id="update<?php //echo $row['id']; ?>">
   <div class="modal-header">
      <button class="close" data-dismiss="modal">×</button>
      <h3>Update <em><?php //echo $row['name']; ?></em></h3>
    </div>
      <div class="modal-body">
          Name:<br />
          <input name="name" type="text" class="input-large" value="<?php //echo $row['name']; ?>" />
          <br />
      </div>
      <div class="modal-footer">
        <button name="cancel" class="btn" data-dismiss="modal"> Cancel </button>
        <button name="update" class="btn btn-success"> Save </button>
        <input name="id" type="hidden" value="<?php //echo $row['id']; ?>" />
      </div>
  </div>
  </form>
<?php //} ?>