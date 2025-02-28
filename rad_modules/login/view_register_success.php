<?php
/* LOGIN.REGISTER.SUCCESS */
/*****************************************************************/
include('../_system/config.php');
include('controller.php'); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registration Success</title>
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
          <h2>Welcome</h2>
          <h4>Your password has been sent to<br /> <?php echo $_SESSION['email'];?></h4>
          <a href="view.php">
            <button name="submit" type="submit" class="btn primary" >Sign in</button>
          </a>
        </div> <!-- /login-form -->
      </div> <!-- /row -->
    </div> <!-- /content -->
  </div> <!-- /container -->
<?php unset($_SESSION['email']); ?>
<?php include('modals.php'); ?>
<!-- Placed at the end of the document so the pages load faster -->
<script src='<?php echo site_Url(); ?>assets/js/jQuery_1.7.2_min.js'></script>
<script src="<?php echo site_Url(); ?>assets/js/jquery.js"></script>
  
</body>
</html>