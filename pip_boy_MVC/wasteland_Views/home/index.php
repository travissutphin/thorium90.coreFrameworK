<?php
	include('pip_boy_MVC/wasteland_Views/html_start.php');
	include('pip_boy_MVC/wasteland_Views/header.php'); 
?>

<style>

  /* Mobile-First Styles */
  .carousel-item {
    position: relative;
    height: 400px; /* Increase height for mobile */
  }

  .carousel-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .carousel-caption {
    position: absolute;
    bottom: 10%;
    left: 5%;
    right: 5%;
    background-color: rgba(0, 0, 0, 0.6); /* Semi-transparent background for text readability */
    padding: 15px;
    border-radius: 5px;
  }

  /* Tablet and Desktop Styles */
  @media (min-width: 768px) {
    .carousel-item {
      height: 600px; /* Slightly larger height for tablets */
    }

    .carousel-caption {
      bottom: 15%;
      left: 10%;
      right: 10%;
    }
  }

  @media (min-width: 1200px) {
    .carousel-item {
      height: 400px; /* Larger height for desktops */
    }

    .carousel-caption {
      bottom: 20%;
      left: 15%;
      right: 15%;
    }
  }


  
</style>


<main>
<div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
  <!-- Carousel Indicators -->
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>

  <!-- Carousel Inner -->
  <div class="carousel-inner">
    <!-- Slide 1 -->
    <div class="carousel-item active">
      <img src="<?php echo images_URL(); ?>thorium90-cms-vault-01.webp" class="img-fluid" alt="Slide 1">

      <div class="container">
        <div class="carousel-caption text-start">
          <h1 class="fs-5 fs-md-3">Build the Future of Web Development with Thorium90</h1>
          <p class="fs-6 fs-md-4">The open-source CMS forged for developers—flexible, scalable, and built to grow with your skills.</p>
          <p><a class="btn btn-primary btn-sm btn-lg" href="#">Download Thorium90 Now</a></p>
        </div>
      </div>
    </div>

    <!-- Slide 2 -->
    <div class="carousel-item">
      <img src="<?php echo images_URL(); ?>thorium90-cms-vault-02.webp" class="img-fluid" alt="Slide 2">

      <div class="container">
        <div class="carousel-caption">
          <h1 class="fs-5 fs-md-3">Step Out of the Vault and Learn to Code from the Ground Up</h1>
          <p class="fs-6 fs-md-4">Master PHP, SQL, and web development with tools designed to teach and empower you—no prior experience required.</p>
          <p><a class="btn btn-primary btn-sm btn-lg" href="#">Start Learning Today</a></p>
        </div>
      </div>
    </div>

    <!-- Slide 3 -->
    <div class="carousel-item">
      <img src="<?php echo images_URL(); ?>thorium90-cms-vault-03.webp" class="img-fluid" alt="Slide 3">

      <div class="container">
        <div class="carousel-caption text-end">
          <h1 class="fs-5 fs-md-3">Forge Your Ultimate CMS with Fully Customizable Tools</h1>
          <p class="fs-6 fs-md-4">From atomic grids to rad modules, Thorium90 adapts to your needs, giving you the freedom to create without limits.</p>
          <p><a class="btn btn-primary btn-sm btn-lg" href="#">Explore Features</a></p>
        </div>
      </div>
    </div>
  </div>

  <!-- Carousel Controls -->
  <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>


<hr class="featurette-divider">

  


  <!-- Marketing messaging and featurettes
  ================================================== -->
  <!-- Wrap the rest of the page in another container to center all the content. -->

  <div class="container marketing mt-3">		
    <!-- Three columns of text below the carousel -->
    <div class="row mt-3">
      <div class="col-lg-4">
		<p class="text-center"><img src="<?php echo images_URL(); ?>circle-01.webp" class="rounded-circle img-fluid"></p>
        <h3 class="text-center">Customizable</h3>
		<p class="text-small text-center">Craft Your Ultimate CMS in the<br />Wasteland with Full Customization</p>
        <p class="text-center"><a class="btn btn-secondary" href="<?php echo get_Url().''.APP_DIRECTORY; ?>#customizable">View details &raquo;</a></p>
		<hr class="featurette-divider">
	  </div><!-- /.col-lg-4 -->
      <div class="col-lg-4">
		<p class="text-center"><img src="<?php echo images_URL(); ?>circle-02.webp" class="rounded-circle img-fluid"></p>
        <h3 class="text-center">S.P.E.C.I.A.L.</h3>
		<p class="text-small text-center">Build a CMS That’s Truly S.P.E.C.I.A.L.<br />for Your Wasteland Needs</p>
        <p class="text-center"><a class="btn btn-secondary" href="<?php echo get_Url().''.APP_DIRECTORY; ?>#special">View details &raquo;</a></p>
		<hr class="featurette-divider">
	  </div><!-- /.col-lg-4 -->
      <div class="col-lg-4">
		<p class="text-center"><img src="<?php echo images_URL(); ?>circle-03.webp" class="rounded-circle img-fluid"></p>
        <h3 class="text-center">Dev Friendly</h3>
		<p class="text-small text-center">Streamline Your Development Workflow<br />with Vault-Tec Precision and Efficiency</p>
        <p class="text-center"><a class="btn btn-secondary" href="<?php echo get_Url().''.APP_DIRECTORY; ?>#dev-friendly">View details &raquo;</a></p>
		<hr class="featurette-divider">
	  </div><!-- /.col-lg-4 -->
    </div><!-- /.row -->

	

	<div class="row mt-3">
		<div class="col-lg-12">
			<h2 class="featurette-heading">Thorium90: The CMS That Survived the Wasteland</h2>
			<p class="lead">The year is 2277. The world is a barren wasteland, a post-apocalyptic expanse where scavengers struggle to piece together functional code from the ruins of the old world. In this digital wasteland, where every keystroke could mean life or death, a beacon of hope emerges: Thorium90, the CMS forged in the radioactive fires of flexibility and adaptability.</p>
		</div>
	</div>

    <!-- START THE FEATURETTES -->


    <div class="row featurette">
      <div class="col-md-7">
		<h2 class="featurette-heading" id="customizable">The Vault of Customization Awaits</h2>
		<p class="lead">Imagine you’re a vault dweller with a dream: to build a website that stands tall amidst the ruins of the web development wasteland. But the wasteland is cruel—most CMS tools feel like ancient terminals locked behind complex puzzles, offering minimal flexibility. That’s where Thorium90 changes the game. Like the Pip-Boy on your wrist, it’s your ultimate survival tool, packed with essential features to get you started, like user management, blogging, and page building. But Thorium90 doesn’t just stop there—it hands you the keys to total customization.</p>
		<p class="lead">Need to build something the Overseer would approve of? Thorium90 gives you the power to adapt, extend, or even replace its components to suit your specific mission. Whether you’re broadcasting tales of Deathclaw hunts or managing a settlement’s supplies, Thorium90 lets you tailor your tools for the job.</p>
      </div>
      <div class="col-md-5">
		<img src="<?php echo images_URL(); ?>1.webp" class="img-fluid img-thumbnail rounded">
      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7 order-md-2">
        <h2 class="featurette-heading" id="special">Why It’s S.P.E.C.I.A.L.</h2>
		<ul>
			<li><span class="fw-bold">S</span>calable Architecture</li>
			<li><span class="fw-bold">P</span>owerful Customization</li>
			<li><span class="fw-bold">E</span>asy for Beginners</li>
			<li><span class="fw-bold">C</span>ollaborative Development</li>
			<li><span class="fw-bold">I</span>ntuitive Tools</li>
			<li><span class="fw-bold">A</span>dvanced Features</li>
			<li><span class="fw-bold">L</span>imitless Possibilities</li>
		</ul>
		<p class="lead">For beginners, Thorium90 is as welcoming as Vault 111 (before the cryopods failed, of course). Its pre-built modules are like ready-made stimpaks for your project—plug them in and get started without breaking a sweat. But as your skills grow, Thorium90 grows with you. Want to build a fully customizable settlement management system? Go for it. Dreaming of a network of interconnected vault logs with advanced permissions? Thorium90 can handle that too.</p>
		<p class="lead">Think of Thorium90 like the mysterious GECK (Garden of Eden Creation Kit): it doesn’t just work - it transforms. Beginners get a safe, structured starting point, while experienced developers wield a toolset with infinite possibilities.</p>
      </div>
      <div class="col-md-5 order-md-1">
		<img src="<?php echo images_URL(); ?>2.webp" class="img-fluid img-thumbnail rounded">
      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading" id="dev-friendly">Mutate Your Development Workflow</h2>
		<p class="lead">The flexibility of Thorium90 is no mere Vault-Tec experiment, it’s a revolution. It takes the restrictions of traditional CMS platforms <span class="fw-bold">(and with the help of AI)</span> and nukes them off the map. The result? A scalable, developer-friendly foundation that empowers you to create exactly what you need. Whether you’re surviving your first project or leading an entire developer faction, Thorium90 ensures you’re prepared for the journey.</p>
		<p class="lead fw-bold">Join the Survivors</p>
		<p class="lead">In a world where other CMS platforms feel like ancient relics with locked-down systems, Thorium90 is the power armor every developer needs. It’s flexible, scalable, and ready to mutate alongside your ambitions. So don’t just survive the wasteland of web development—thrive with Thorium90.</p>
		<p class="lead">Thorium90: It’s not just a CMS - it’s your survival kit.</p>
      </div>
      <div class="col-md-5">
        <img src="<?php echo images_URL(); ?>3.webp" class="img-fluid img-thumbnail rounded">
      </div>
    </div>

    <hr class="featurette-divider">

    <!-- /END THE FEATURETTES -->

  </div><!-- /.container -->


</main>



<?php
	include('pip_boy_MVC/wasteland_Views/footer.php');
	include('pip_boy_MVC/wasteland_Views/html_end.php');
?>