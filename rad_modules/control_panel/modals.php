<?php
/* CONTROL_PANEL.MODALS */
/*****************************************************************/

/**
  * @desc	display create
  * @param	
  * @return 
*/
?>
<form name="create" action="controller.php" method="post">
<div class="modal hide fade" id="scheduleDate">
 <div class="modal-header">
    <button class="close" data-dismiss="modal">×</button>
    <h3>Add</h3>
  </div>
    <div class="modal-body">
        Name: <input type="text" name="name" id="schedule_on" value="" /><br />
    </div>
    <div class="modal-footer">
      <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
      <button class="btn btn-primary"> Add </button>
    </div>
</div>
</form>

<?php
/*****************************************************************/
?>

<?php
/**
  * @desc	display update
  * @param	
  * @return 
  * @note	modal data must exist on the page when called
  *			so to update records, each record must be loaded
  *			to the page from the beginning
*/
?>
	<?php //$records_all = read_(); ?>
    <?php //while ($row = mysql_fetch_array($records_all)){ ?>
      <form name="manage" action="controller.php" method="post">
      <div class="modal hide fade" id="update<?php //echo $row['id']; ?>">
       <div class="modal-header">
          <button class="close" data-dismiss="modal">×</button>
          <h3>Update <em><?php //echo $row['name'] ?></em></h3>
        </div>
          <div class="modal-body">
           
          </div>
          <div class="modal-footer">
            <button name="cancel" class="btn" data-dismiss="modal"> Cancel </button>
            <button name="update" class="btn btn-success"> Save </button>
            <input name="id" type="hidden" value="<?php //echo $row['id']; ?>" />
          </div>
      </div>
      </form>
    <?php //} ?>