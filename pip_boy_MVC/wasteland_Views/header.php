<?php /*
<header class="header">
  <nav class="navbar navbar-expand-lg navbar-light index-forward bg-white">
    <div class="container">
      <div class="row w-100 align-items-center">
        <!-- Column 1: Title and Text -->
        <div class="col-9 col-lg-auto">
          <h1 class="h1 mb-0">
            <a class="d-block reset-anchor" href="<?php echo get_URL(); ?>"><img src="<?php echo get_URL(); ?>assets/images/logo-horizontal-jenna-grace.png" alt="JennaGrace.art Crochet"></a>
          </h1>
          <p></p>
        </div>
        
        <!-- Column 2: Social Links aligned to the right -->
        <div class="col-3 col-lg-auto ms-lg-auto order-lg-last">
          <ul class="list-inline mb-0 text-end">
            <li class="list-inline-item">
              <a class="reset-anchor" target="_blank" href=""><i class="fab fa-github"></i></a>
            </li>
            <li class="list-inline-item">
              <a class="reset-anchor" target="_blank" href=""><i class="fab fa-linkedin"></i></a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  
  <nav class="navbar navbar-expand-lg navbar-light border-top border-bottom border-light">
    <div class="container">
      <button class="navbar-toggler navbar-toggler-end" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span></span><span></span><span></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item">
            <a class="nav-link active" href="<?php echo get_URL(); ?>">Home</a>
          </li>
          
		  <li class="nav-item">
            <a class="nav-link active" href="<?php echo get_URL(); ?>blog">Blog</a>
          </li>
		  
		  <li class="nav-item">
            <a class="nav-link active" href="<?php echo get_URL(); ?>store">Store</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>

*/ ?>

  
    
<nav class="navbar <?php echo DARK_LIGHT_MODE_NAV_FOOTER; ?>">
	<div class="container py-3">

		<!-- Mobile Logo -->
		<a class="navbar-brand d-lg-none" href="<?php echo get_Url().''.APP_DIRECTORY; ?>">
			<img src="<?php echo images_Url(); ?>header.png" class="align-middle me-1 img-fluid" alt="<?php echo DEFAULT_TITLE; ?>">
		</a>
		<!-- end Mobile Logo-->

		<!-- Desktop Logo -->
		<div class="lc-block position-absolute start-50 translate-middle top-50 d-none d-lg-block"><a editable="inline" class="navbar-brand mx-auto" href="<?php echo get_Url().''.APP_DIRECTORY; ?>">
				<img src="<?php echo images_Url(); ?>header.png" class="d-block mx-auto img-fluid" alt="<?php echo DEFAULT_TITLE; ?>">
			</a></div>
		<!-- end Desktop Logo-->

		<div class="lc-block d-none d-lg-block">
			<form role="search" method="get" id="searchform" action="/">
				<div class="input-group">
					<input type="text" value="" name="s" id="s" class="form-control" placeholder="Search..." aria-label="Search">
					<span class="input-group-text" id="basic-addon2">
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" class="text-dark" width="1rem" height="1rem" viewBox="0 0 24 24" style="" lc-helper="svg-icon" fill="currentColor">
							<path d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z"></path>
						</svg>
					</span>
				</div>

			</form>
		</div>

		<div class="lc-block d-flex ms-auto gap-2 me-2">
			<div class="lc-block nav-item d-none d-md-block"><!-- do not show on mobile-->
				<a href="https://github.com/travissutphin/thorium90.app" target="_blank" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
					<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-github custom-icon" viewBox="0 0 16 16">
					  <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27s1.36.09 2 .27c1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.01 8.01 0 0 0 16 8c0-4.42-3.58-8-8-8"/>
					</svg>
				</a>
				<a href="https://www.linkedin.com/in/travis-sutphin-4472a1a/" target="_blank" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
					<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-linkedin custom-icon" viewBox="0 0 16 16">
						<path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z"/>
					</svg>
				</a>
			</div>
		</div>

		<!-- Menu -->
		<button class="navbar-toggler" data-bs-toggle="offcanvas" data-bs-target="#navbarNavHamburger" aria-controls="navbarNavHamburger">
			<span class="navbar-toggler-icon"></span>
		</button>


		<!-- START OFFCANVAS -->
		<!-- To customize and view the offcanvas, utilize the "show" class, but make sure to remove it once you are finished. -->
		<div class="offcanvas offcanvas-end shadow <?php echo DARK_LIGHT_MODE_NAV_FOOTER; ?>" tabindex="-1" id="navbarNavHamburger" aria-labelledby="navbarNavHamburgerLabel">
			<div class="offcanvas-header border-bottom">
				<div class="lc-block">
					<div editable="rich">
						<h5 class="offcanvas-title <?php echo DARK_LIGHT_MODE_TEXT; ?>" id="navbarNavHamburgerLabel">Vault-Tec Navigator</h5>
					</div>
				</div>

				<button type="button" class="btn-close btn-close-white" style="transform: scale(1.5);" data-bs-dismiss="offcanvas" aria-label="Close"></button>

			</div>
			<div class="offcanvas-body">
				<div class="row">
					<div class="col-12">
						<div class="lc-block mb-4">
							<div lc-helper="shortcode" class="live-shortcode me-auto"><!--  lc_nav_menu --> 
								<ul id="menu-menu-1" class="navbar-nav">
									<h5 class="offcanvas-title <?php echo DARK_LIGHT_MODE_TEXT; ?>" id="navbarNavHamburgerLabel">Our Overseer's Note</h5>
									<li class="menu-item menu-item-type-custom menu-item-object-custom nav-item nav-item-32739"><a href="our-goal" class="nav-link ">Our Goal (G.E.C.K.)</a></li>
									<li class="menu-item menu-item-type-custom menu-item-object-custom nav-item nav-item-32739"><a href="thorium90-framework" class="nav-link ">Thorium90 Framework</a></li>
									<h5 class="offcanvas-title <?php echo DARK_LIGHT_MODE_TEXT; ?>" id="navbarNavHamburgerLabel">Vaults</h5>
									<li class="menu-item menu-item-type-custom menu-item-object-custom nav-item nav-item-32739"><a href="blog" class="nav-link ">Blog</a></li>
									<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home nav-item nav-item-32738"><a href="store" class="nav-link ">Store</a></li>
								</ul><!-- /lc_nav_menu --> 
							</div>
						</div>
						
			<div class="lc-block nav-item">
				<a href="https://github.com/travissutphin/thorium90.app" target="_blank" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
					<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-github custom-icon" viewBox="0 0 16 16">
					  <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27s1.36.09 2 .27c1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.01 8.01 0 0 0 16 8c0-4.42-3.58-8-8-8"/>
					</svg>
				</a>
				<a href="https://www.linkedin.com/in/travis-sutphin-4472a1a/" target="_blank" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
					<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-linkedin custom-icon" viewBox="0 0 16 16">
						<path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z"/>
					</svg>
				</a>
			</div>
			<hr />
						
						<div class="lc-block d-grid gap-3">
							<a class="btn btn-secondary" href="#" role="button">Sign in</a>
							<a class="btn btn-secondary" href="#" role="button">Sign up</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- END OFFCANVAS -->
	</div>
</nav>
<hr />