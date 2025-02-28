<?php
	include('pip_boy_MVC/wasteland_Views/html_start.php');
	include('pip_boy_MVC/wasteland_Views/header.php'); 
	if($show_latest_post == 'yes'){ include('latest_post.php'); }
	if($show_top_categories == 'yes'){ include('top_categories.php'); }
?>

    <!-- Home listing-->
    <section class="pb-5 pt-3">
      <div class="container pb-4">
        <div class="row gy-5">
          <div class="col-lg-9">
			<?php while($row = mysqli_fetch_array($display_blog)) { ?>	
			<div class="row align-items mt-2 mb-5">
              <!---post-trending to show tab--->
			  <div class="col-lg-6">
			  <?php if($row['video_primary'] != ''){ ?>
				<div class="ratio ratio-16x9">
					<iframe src="<?php echo $row['video_primary']; ?>" allowfullscreen></iframe>
				</div>
				<?php }else{ ?>
					<a class="d-block mb-4" title="<?php echo $row['title'];?>" href="<?php echo $row['alias'];?>"><img class="img-fluid img-thumbnail rounded mx-auto d-block" src="assets/images_blog/<?php echo $row['image_primary']; ?>" alt="<?php echo $row['title'];?>" /></a>
				<?php } ?>
              </div>
              <div class="col-lg-6">
				<p><a class="category-link fw-normal" href="<?php echo $row['bcalias'];?>"><?php echo $row['category']; ?></a></p>
				<p><a class="text-uppercase meta-link fw-normal" href="#!">Travis Sutphin</a>
                <a class="text-uppercase meta-link fw-normal" href="#!">(<?php echo format_Dates_Times($row['created_at'],$format='full'); ?>)</a></p>
				<h1 class="h3 mb-4"><a class="d-block reset-anchor" href="<?php echo $row['alias'];?>"><?php echo $row['title'];?></a></h1>
                <p class="text"><?php echo $row['content_intro']; ?></p><a class="btn btn-link p-0 read-more-btn" href="<?php echo $row['alias'];?>"><span><b>Read more</b></span><i class="fas fa-long-arrow-alt-right"></i></a>
              </div>
            </div>
			<?php } ?>
			
						
            <!-- Quote -->
			<figure class="bg-dark text-white p-4 p-lg-5 text-center mb-5">
              <?php while($quote = mysqli_fetch_array($random_quote)) { ?>
			  <blockquote class="blockquote">
                <p class="h4 mb-5"><?php echo $quote['quote']; ?></p>
              </blockquote>
              <figcaption class="blockquote-footer">
                <cite class="fst-normal text-white" title="Source Title"><?php echo $quote['author']; ?></cite>
              </figcaption>
			  <?php } ?>
            </figure>
            <!-- Pagination -->
            <nav aria-label="Page navigation example">
              <ul class="pagination">
                <li class="page-item"><a class="page-link" href="#!">&laquo;</a></li>
                <li class="page-item active"><a class="page-link" href="#!">1</a></li>
                <li class="page-item"><a class="page-link" href="#!">&raquo;</a></li>
              </ul>
            </nav>
          </div>
          <!-- Blog sidebar-->
          <div class="col-lg-3">
            <?php include('side_bar.php'); ?>
          </div>
        </div>
      </div>
    </section>
<?php
	include('pip_boy_MVC/wasteland_Views/footer.php');
	include('pip_boy_MVC/wasteland_Views/html_end.php');
?>