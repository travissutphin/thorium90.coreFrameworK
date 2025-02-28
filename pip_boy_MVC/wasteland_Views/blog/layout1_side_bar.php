 
<div class="col-md-4">
      <div class="position-sticky" style="top: 2rem;">
        <div class="p-4 mb-3 bg-body-tertiary rounded">
          
<?php if (isset($display_post_image)): ?>
    <?php while ($image = mysqli_fetch_array($display_post_image)): ?>
        <img class="img-fluid" src="<?php echo blog_images_Url() . $image['image_primary']; ?>" alt="Post Image">
    <?php endwhile; ?>
<?php else: ?>
    <h4 class="fst-italic text-dark">Thorium90 is S.P.E.C.I.A.L.</h4>
    <p class="mb-0 text-dark">
	The Thorium90 Fallout stories are in production and will be released here as they are completed.
    </p>
<?php endif; ?>

		
		
		</div>


<?php /*
        <div>
          <h4 class="fst-italic">Recent posts</h4>
          
		  <ul class="list-unstyled">
            <li>
              <a class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 link-body-emphasis link-primary border-top" href="#">
                <svg class="bd-placeholder-img" width="100%" height="96" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"/></svg>
                <div class="col-lg-8">
                  <h6 class="mb-0">Example blog post title</h6>
                  <small class="text-body-secondary">January 15, 2024</small>
                </div>
              </a>
            </li>
          </ul>
		  
        </div>
*/ ?>
        
      </div>
    </div>






<?php /*
 <?php if(isset($_REQUEST['alias']) and $_REQUEST['alias'] != '') { ?>
			<!-- Recent posts-->
            <div class="card mb-4 d-none d-md-block d-lg-block d-xl-block d-xxl-block">
              <div class="card-body p-0">
                
				<?php if(isset($row['image_primary']) AND $row['image_primary'] !== NULL){ ?>
				<img class="w-100 mb-2 " src="assets/images_blog/<?php echo $row['image_primary']; ?>" alt="<?php echo $row['title'];?>" title="<?php echo $row['title'];?>">
                <?php } ?>
				
				
				
				
<div class="col-lg-12">
	
	<?php if(isset($row['knowledge_by_percentage']) AND $row['knowledge_by_percentage'] > 5){ ?>
	<div class="container">
        <!-- Row 1 -->
<div class="container">
    <div class="row">
        <div class="col">
            <p>Read</p>
        </div>
        <div class="col text-center text-md-center">
            <p>Applied</p>
        </div>
        <div class="col text-end text-md-end">
            <p>Mastered</p>
        </div>
    </div>
</div>

        
        <!-- Row 2 -->
        <div class="row">
            <div class="col-12">
                <div class="progress">
                    <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: <?php echo $row['knowledge_by_percentage'];?>%" aria-valuenow="<?php echo $row['knowledge_by_percentage'];?>" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
		
		<div class="row">
            <div class="col-12 text-md-end">
                <a href="learn-by-reading-master-by-doing">What is Read,Applied,Mastered?</a>
            </div>
        </div>
		
    </div>
	<?php } ?>

	</div>				
				
				
				
				
				
				
				
				
				
				
				
				
				
				<div class="d-flex mb-3"><a class="flex-shrink-0" href="post.html"><img class="img-fluid" src="img/recent-post-1.jpg" alt="" width="70"></a>
                  <div class="ms-3">
                    <h6> <a class="reset-anchor" href="post.html"></a></h6>
                    <p class="text-sm text-muted lh-sm mb-0"></p>
                  </div>
                </div>
              </div>
            </div>
			<?php } ?>
            <!-- Categories -->
            <div class="card mb-4 d-none d-md-block d-lg-block d-xl-block d-xxl-block">
              <div class="card-body p-0">
                <h2 class="h5 mb-3">Categories</h2>
				<?php while($row_categories_blog = mysqli_fetch_array($display_categories_blog)) { ?>
				<a class="category-block category-block-sm bg-center bg-cover mb-2" style="background: url(assets/images/<?php echo $row_categories_blog['photo']; ?>)" href="<?php echo $row_categories_blog['alias']; ?>"><span class="category-block-title">
				<?php echo $row_categories_blog['category']; ?></span></a>
				<?php } ?>
              </div>
            </div>
            <!-- Tags-->
            <div class="card mb-2">
              <div class="card-body p-0">
                <h2 class="h5 mb-3">Tags cloud</h2>
                <ul class="list-inline">
                  <?php while($row_tags_blog = mysqli_fetch_array($display_tags_blog)) { ?>
				  <li class="list-inline-item my-1 me-2"><a class="sidebar-tag-link" href="<?php echo $row_tags_blog['alias']; ?>"><?php echo $row_tags_blog['tag']; ?></a></li>
				  <?php } ?>
                </ul>
              </div>
            </div>
            <!-- Ad-->
            <div class="card mb-4">
              <div class="card-body p-0"><a class="d-block" href="#!"><img class="img-fluid" src="img/banner.jpg" alt=""></a></div>
            </div>
*/ ?>