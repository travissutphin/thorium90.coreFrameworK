<?php
/* CONTROL_PANEL.VIEW */
/*****************************************************************/
include('../templates/header.php');
include('controller.php');
/**
  * @desc	all body content would go inside here
  * @param	
  * @return 
*/
?>


<h1>Welcome</h1>

<?php echo $_SESSION['users.email']; ?>


<?php
/*****************************************************************/
include('../templates/footer.php');
?>