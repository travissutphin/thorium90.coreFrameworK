<?PHP
/* USERS.MODALS */
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
            Password:<br />
            <input name="password" type="text" class="input-large" value="" />
            <br />
            First Name:<br />
            <input name="name_first" type="text" class="input-large" value="" />
            <br />
            Last Name:<br />
            <input name="name_last" type="text" class="input-large" value="" />
            <br />
            Email:<br />
            <input name="email" type="text" class="input-large" value="" />
            <br />
            Role:<br />
            <?php html_list_Roles(); ?>
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
<?php $records_all = read_Users(); ?>
<?php while ($row = mysqli_fetch_array($records_all)){ ?>
  <form name="manage" action="view.php" method="post">
  <div class="modal hide fade" id="update<?php echo $row['id']; ?>">
   <div class="modal-header">
      <button class="close" data-dismiss="modal">×</button>
      <h3>Update <em><?php echo $row['name_first'].' '.$row['name_last']; ?></em></h3>
    </div>
      <div class="modal-body">
          Password:<br />
          <input name="password" type="text" class="input-large" value="<?php echo $row['password']; ?>" />
          <br />
          First Name:<br />
          <input name="name_first" type="text" class="input-large" value="<?php echo $row['name_first']; ?>" />
          <br />
          Last Name:<br />
          <input name="name_last" type="text" class="input-large" value="<?php echo $row['name_last']; ?>" />
          <br />
          Email:<br />
          <input name="email" type="text" class="input-large" value="<?php echo $row['email']; ?>" />
          <br />
          Role:<br />
          <?php html_list_Roles($row['role_id']); ?>
      </div>
      <div class="modal-footer">
        <button name="cancel" class="btn" data-dismiss="modal"> Cancel </button>
        <button name="update" class="btn btn-success"> Save </button>
        <input name="id" type="hidden" value="<?php echo $row['id']; ?>" />
      </div>
  </div>
  </form>
<?php } ?>