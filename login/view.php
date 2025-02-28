<?php
/* LOGIN.VIEW */
/*****************************************************************/
include('../_system/config.php');
include('controller.php'); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Team Manager</title>
<link href="<?php echo site_Url(); ?>assets/css/bootstrap.css" rel="stylesheet">
<link href="<?php echo site_Url(); ?>assets/css/bootstrap_custom.css" rel="stylesheet">
<link href="<?php echo site_Url(); ?>assets/css/bootstrap-responsive.css" rel="stylesheet">
<link href="<?php echo site_Url(); ?>assets/css/bootstrap-login.css" rel="stylesheet">
</head>
<body>

 <div class="container">
    <div class="content">
      <div class="row">
        <div class="login-form">
          <h2>Login</h2>
		  
		  <?php if(isset($_GET['return'])) { echo messages($_GET['return']); } ?>
          <?php if(isset($_SESSION['message'])) { echo messages($_SESSION['message']); unset($_SESSION['message']); } ?>
          <form name="manage" action="view.php" method="post">
            <fieldset>
              <div class="clearfix">
                <div class="input-prepend">
                  <span class="add-on"><i class="icon-user"></i></span>
                  <input name="email" type="text" class="input-large" id="inputIcon" placeholder="Email">
                </div>
              </div>
              <p></p>
              <div class="clearfix">
                <div class="input-prepend">
                  <span class="add-on"><i class="icon-lock"></i></span>
                  <input name="password" type="password" class="input-large" id="inputIcon" placeholder="Password">
                </div>
              </div>
              <p></p>
              <button name="submit" type="submit" class="btn primary" >Sign in</button>              
              <a data-toggle="modal" href="#register" class="btn">Register</a>
              <a data-toggle="modal" href="#forgot-password" class="btn">Forgot Password</a>
            </fieldset>
          </form>
        </div> <!-- /login-form -->
      </div> <!-- /row -->
    </div> <!-- /content -->
  </div> <!-- /container -->
  

<?php include('modals.php'); ?>
<!-- Placed at the end of the document so the pages load faster -->
<script src='<?php echo site_Url(); ?>assets/js/jQuery_1.7.2_min.js'></script>
<script src="<?php echo site_Url(); ?>assets/js/jquery.js"></script>
<script src="<?php echo site_Url(); ?>assets/js/bootstrap-datepicker.js"></script>
<script src="<?php echo site_Url(); ?>assets/js/bootstrap-transition.js"></script>
<script src="<?php echo site_Url(); ?>assets/js/bootstrap-alert.js"></script>
<script src="<?php echo site_Url(); ?>assets/js/bootstrap-modal.js"></script>
<script src="<?php echo site_Url(); ?>assets/js/bootstrap-dropdown.js"></script>
<script src="<?php echo site_Url(); ?>assets/js/bootstrap-scrollspy.js"></script>
<script src="<?php echo site_Url(); ?>assets/js/bootstrap-tab.js"></script>
<script src="<?php echo site_Url(); ?>assets/js/bootstrap-tooltip.js"></script>
<script src="<?php echo site_Url(); ?>assets/js/bootstrap-popover.js"></script>
<script src="<?php echo site_Url(); ?>assets/js/bootstrap-button.js"></script>
<script src="<?php echo site_Url(); ?>assets/js/bootstrap-collapse.js"></script>
<script src="<?php echo site_Url(); ?>assets/js/bootstrap-carousel.js"></script>
<script src="<?php echo site_Url(); ?>assets/js/bootstrap-typeahead.js"></script>
<script src="<?php echo site_Url(); ?>assets/js/bootstrap-timepicker.js"></script>
  
</body>
</html>