<?php
/* INSTALL_COMPLETE.VIEW */
/*****************************************************************/
include('../_system/config.php');
include('controller.php'); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome</title>
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
          <h2>Welcome to your web app</h2>
			
            <p>If this page is not displaying correctly, it is possible your app is not in the root directory.</P>
            <p>To fix this, go to the config file..</p>
            <ul>
            	<li>/modules/_system/config.php</li>
            </ul>
            <p>On lne 16, you will see  define("APP_DIRECTORY", "/"); </p>
            <p>Change this to match the directory the app is in.</p>
            <p>For example, if your app is in http://www.yourdomain.com/your_web_app</p>
            <p>Then it should be define("APP_DIRECTORY", "/your_web_app/");</p>
            
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