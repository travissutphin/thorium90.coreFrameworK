<?php
	include('pip_boy_MVC/wasteland_Views/html_start.php');
	include('pip_boy_MVC/wasteland_Views/header.php'); 
?>


<div class="container">
  <header class="border-bottom lh-1 py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
      <div class="col-4 pt-1">
        <a class="btn btn-sm btn-secondary" href="<?php echo get_Url().''.APP_DIRECTORY; ?>">Subscribe</a>
      </div>
      <div class="col-4 d-flex justify-content-end align-items-center">
        <a class="btn btn-sm btn-secondary" href="#">Sign up</a>
      </div>
    </div>
  </header>

  <div class="nav-scroller py-1 mb-3 border-bottom">
    <nav class="nav justify-content-between">
      <?php while($row_categories_blog = mysqli_fetch_array($display_categories_blog)) { ?>
		<a class="nav-item nav-link link-primary" href="<?php echo $row_categories_blog['alias']; ?>"><?php echo $row_categories_blog['category']; ?></a>
	  <?php } ?>
    </nav>
  </div>
</div>

<main class="container">
  
	<div class="row g-5">
		<div class="col-md-8">
		<?php while($row = mysqli_fetch_array($display_post)) { ?>
				  
				  <h1 class="mb-0"><?php echo $row['title'];?></h1><hr />
				  
				  <p class="card-text mb-auto"><?php echo $row['content_full']; ?></p> 
				  
		<?php } ?>
		</div>
		<?php include('layout1_side_bar.php'); ?>
	</div>
</main>


<?php
	include('pip_boy_MVC/wasteland_Views/footer.php');
	include('pip_boy_MVC/wasteland_Views/html_end.php');
?>