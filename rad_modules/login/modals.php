<?php
/* LOGIN.MODALS */
/*****************************************************************/
?>

<?php
/** 
  * @desc	display registration form
  * @param	
  * @return 
*/
?>
    <form name="manage" action="view.php" method="post">
    <div class="modal hide fade" id="register">
     <div class="modal-header">
        <button class="close" data-dismiss="modal">×</button>
        <h3>Register</h3>
      </div>
        <div class="modal-body">
            First Name:<br />
            <input name="name_first" type="text" class="input-large" value="" /><br />
            Last Name:<br />
            <input name="name_last" type="text" class="input-large" value="" /><br />
            Email:<br />
            <input name="email" type="text" class="input-large" value="" /><br />
        </div>
        <div class="modal-footer">
          <button class="btn" data-dismiss="modal" aria-hidden="true"> Cancel </button>
          <button name="register" class="btn btn-success"> Save </button>
          <input name="role_id" type="hidden" value="3" />
        </div>
    </div>
    </form>



<?php
/** 
  * @desc	display forgot-password form
  * @param	
  * @return 
*/
?>
    <form name="manage" action="view.php" method="post">
    <div class="modal hide fade" id="forgot-password">
     <div class="modal-header">
        <button class="close" data-dismiss="modal">×</button>
        <h3>Forgot Password</h3>
      </div>
        <div class="modal-body">
            Email:<br />
            <input name="email" type="text" class="input-large" value="" /><br />
        </div>
        <div class="modal-footer">
          <button class="btn" data-dismiss="modal" aria-hidden="true"> Cancel </button>
          <button name="forgot_password" class="btn btn-success"> Retrieve </button>
          <input name="role_id" type="hidden" value="3" />
        </div>
    </div>
    </form>