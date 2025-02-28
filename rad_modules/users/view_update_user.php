<?php
/* USERS.VIEW */
/*****************************************************************/
include('../templates/header.php');
include('controller.php');
?>

<div class="container-fluid" id="container">
    <div class="span2" id="content"></div>
    <div class="span5" id="content"><?php echo messages($_GET['return']); ?></div>
</div>

<div class="container-fluid" id="container">
    
    <div class="span2" id="content"></div>
    
    <div class="span8" id="content">
     
        <div class="row-fluid">

            <h2>Update your login credentials</h2>
            
              <form name="change_password" action="view.php" method="post">
              	Email:<br />      
                <input name="email" type="text" value="" />
                <br /><br />
                Password:<br />      
                <input name="password" type="password" value="" />
                <br /><br />
                <input name="update" type="hidden" value="" />
                <input name="change_password" type="hidden" value="" />
                <input name="role_id" type="hidden" value="1" />
                <button name="update" class="btn btn-success"> Save </button>
                <input name="id" type="hidden" value="<?php echo $_SESSION['id']; ?>" />
              </form>
        
        </div><!-- // row-fluid -->
        
    </div> <!-- // span12 -->                 

</div> <!-- //container-fluid --> 

<?php
include('modals.php');
include('../templates/footer.php');
?>