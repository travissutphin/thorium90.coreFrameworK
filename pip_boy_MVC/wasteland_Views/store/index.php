<?php
	include('pip_boy_MVC/wasteland_Views/html_start.php');
	include('pip_boy_MVC/wasteland_Views/header.php'); 
?>

<!-- Learn what all this code means - https://travissutphin.com/bootstrap-card-for-all-devices -->

<div class="container py-4">
	<!-- Row with gutters (g-4) for spacing between cards -->
	<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
		
		<?php foreach ($get_all_store_items as $item) { ?>
		<!-- Card -->
		<div class="col">
			<div class="card h-100 shadow-sm <?php echo DARK_LIGHT_MODE; ?> border">
				<img src="<?php echo store_images_Url(); ?><?php echo $item['primary_image']; ?>" class="card-img-top" alt="<?php echo $item['title']; ?>">
				<div class="card-body">
					<h5 class="card-title"><?php echo $item['title']; ?></h5>
					<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
				</div>
				<div class="card-footer bg-transparent border-top-0">
					<a href="<?php echo $item['alias']; ?>"><button type="button" class="btn btn-primary">Product Details</button></a>
				</div>
			</div>
		</div>
		<?php } ?> 
		
	</div>
</div>

<?php
	include('pip_boy_MVC/wasteland_Views/footer.php');
	include('pip_boy_MVC/wasteland_Views/html_end.php');
?>