<?php
	include('pip_boy_MVC/wasteland_Views/html_start.php');
	include('pip_boy_MVC/wasteland_Views/header.php'); 
?>

	<?php foreach ($pages as $page) { echo $page['content']; } ?>

<?php
	include('pip_boy_MVC/wasteland_Views/footer.php');
	include('pip_boy_MVC/wasteland_Views/html_end.php');
?>