<?php
	include('pip_boy_MVC/wasteland_Views/html_start.php');
	include('pip_boy_MVC/wasteland_Views/header.php'); 
?>

<?php foreach($get_store_item_details as $item) { ?>
<?php 
		$get_store_images = get_store_images($item['id']); 
		$count_store_images = count_store_images($item['id']);
?>
   <!-- Main Card -->
    <div class="container py-4">
        <div class="card bg-dark text-light border">
            <div class="row g-0">
                <!-- Image Carousel Column -->
                <div class="col-12 col-md-6 col-lg-8">
                    <div id="cardCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <?php $count_store_images = $count_store_images-1; ?>
							<?php for ($x = 0; $x <= $count_store_images; $x++) { ?>
							<button type="button" data-bs-target="#cardCarousel" data-bs-slide-to="<?php echo $x; ?>" <?php if($x == 1){ echo 'class="active"'; } ?>></button>
							<?php } ?>
                        </div>
                        <div class="carousel-inner">
                            <?php $y = 0; ?>
							<?php while($image = mysqli_fetch_array($get_store_images)) { ?>
							
							<div class="carousel-item <?php if($y == 0) {echo 'active'; $y++; } ?>">
                                <img src="<?php echo store_images_Url(); ?><?php echo $image['image_name']; ?>" class="d-block w-100" alt="<?php echo $image['image_name']; ?>">
                            </div>
							<?php } ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#cardCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#cardCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>
                </div>

                <!-- Details Column -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card-body">
                        <h2 class="card-title mb-3"><?php echo $item['title']; ?></h2>
                        
						<?php 	if ($item['availability'] == '0'){
								echo '<div class="alert alert-danger d-inline-block mb-3">
										<strong>Out of Stock</strong>
									  </div>' ;
							}elseif ($item['availability'] >= '10') {
								echo '<div class="alert alert-success d-inline-block mb-3">
										<strong>Available</strong>
									  </div>' ;
							}elseif ($item['availability'] < '10') {
								echo '<div class="alert alert-success d-inline-block mb-3">
										<strong>Available</strong>
									  </div>' ; 
							}
						?>
                        
                        <h3 class="text-primary mb-3">$ <?php echo $item['retail_cost']; ?></h3>
                        
                        <div class="mb-4">
                            <p class="lead"><?php echo $item['tagline']; ?></p>
                        </div>
                        
                        <div class="mb-4">
                            <h4 class="h5">Description</h4>
                            <p><?php echo $item['description']; ?></p>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>



<?php
	include('pip_boy_MVC/wasteland_Views/footer.php');
	include('pip_boy_MVC/wasteland_Views/html_end.php');
?>