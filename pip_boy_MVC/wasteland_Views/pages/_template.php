<?php
	include('pip_boy_MVC/wasteland_Views/html_start.php');
	include('pip_boy_MVC/wasteland_Views/header.php'); 
?>


    
    <!-- Custom CSS -->
    <style>
        /* Custom styles */
        .hero-banner {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('placeholder-banner.jpg');
            background-size: cover;
            background-position: center;
            min-height: 300px;
            display: flex;
            align-items: center;
        }

        .team-member-img {
            width: 150px;
            height: 150px;
            object-fit: cover;
        }

        .testimonial-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .testimonial-avatar {
            width: 80px;
            height: 80px;
            object-fit: cover;
        }

        .social-icon {
            width: 40px;
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
            border-radius: 50%;
            transition: transform 0.3s ease;
        }

        .social-icon:hover {
            transform: translateY(-3px);
            background-color: var(--bs-primary);
            color: white !important;
        }

        .contact-icon {
            width: 60px;
            height: 60px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: var(--bs-primary);
            color: white;
            border-radius: 50%;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .stat-card {
            border-left: 4px solid var(--bs-primary);
        }

        /* Map container */
        .map-container {
            height: 400px;
            background-color: #f8f9fa;
        }

        /* Timeline styling */
        .timeline {
            position: relative;
            padding-left: 3rem;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 2px;
            background-color: var(--bs-primary);
        }

        .timeline-item {
            position: relative;
            padding-bottom: 2rem;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -3rem;
            top: 0.5rem;
            width: 1rem;
            height: 1rem;
            border-radius: 50%;
            background-color: var(--bs-primary);
        }
    </style>

    <!-- Page Banner -->
    <section class="hero-banner text-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="text-white text-decoration-none">Home</a></li>
                            <li class="breadcrumb-item active text-white" aria-current="page">Page Title</li>
                        </ol>
                    </nav>
                    <h1 class="display-4 fw-bold mb-4">Page Title</h1>
                    <p class="lead mb-0">A brief description or tagline that explains what this page is about and what visitors can expect to find here.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content Section -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <!-- Main Content Column -->
                <div class="col-lg-8">
                    <!-- Content Block -->
                    <div class="mb-5">
                        <h2>Main Heading</h2>
                        <p class="lead">An introductory paragraph that sets the context for the content that follows. This should be engaging and informative.</p>
                        <p>Detailed content goes here. This can be customized based on the page type (About Us, Contact, etc.) while maintaining consistent styling.</p>
                    </div>

                    <!-- Example Content Blocks -->
                    <!-- About Us Content -->
                    <div class="mb-5 ">
                        <h3>Our Story</h3>
                        <div class="timeline">
                            <div class="timeline-item">
                                <h4>2020</h4>
                                <p>Company founding and initial concept development.</p>
                            </div>
                            <div class="timeline-item">
                                <h4>2022</h4>
                                <p>Major expansion and launch of new product lines.</p>
                            </div>
                            <div class="timeline-item">
                                <h4>2024</h4>
                                <p>International market entry and digital transformation.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Form -->
                    <div class="mb-5 d-none">
                        <form>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">First Name</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Phone</label>
                                    <input type="tel" class="form-control">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Message</label>
                                    <textarea class="form-control" rows="5"></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Testimonials Grid -->
                    <div class="mb-5 d-none">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="testimonial-card p-4">
                                    <div class="d-flex mb-4">
                                        <img src="placeholder-testimonial1.jpg" class="testimonial-avatar rounded-circle me-3" alt="Client Name">
                                        <div>
                                            <h5 class="mb-1">Client Name</h5>
                                            <p class="small text-muted mb-0">Position, Company</p>
                                        </div>
                                    </div>
                                    <p class="mb-0">"Testimonial content goes here. This should be a genuine review or feedback from a satisfied customer."</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Column -->
                <div class="col-lg-4">
                    <!-- Contact Information Sidebar -->
                    <div class="card border-0 shadow-sm mb-4 d-none">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Contact Information</h4>
                            <div class="d-flex mb-3">
                                <i class="bi bi-geo-alt text-primary fs-4 me-3"></i>
                                <div>
                                    <h6 class="mb-1">Address</h6>
                                    <p class="mb-0">123 Street Name<br>City, State 12345</p>
                                </div>
                            </div>
                            <div class="d-flex mb-3">
                                <i class="bi bi-telephone text-primary fs-4 me-3"></i>
                                <div>
                                    <h6 class="mb-1">Phone</h6>
                                    <p class="mb-0">(123) 456-7890</p>
                                </div>
                            </div>
                            <div class="d-flex">
                                <i class="bi bi-envelope text-primary fs-4 me-3"></i>
                                <div>
                                    <h6 class="mb-1">Email</h6>
                                    <p class="mb-0">contact@example.com</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Stats Sidebar -->
                    <div class="card border-0 shadow-sm mb-4 d-none">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Company Stats</h4>
                            <div class="stat-card p-3 mb-3">
                                <h3 class="mb-1">1,000+</h3>
                                <p class="small text-muted mb-0">Happy Customers</p>
                            </div>
                            <div class="stat-card p-3 mb-3">
                                <h3 class="mb-1">50+</h3>
                                <p class="small text-muted mb-0">Team Members</p>
                            </div>
                            <div class="stat-card p-3">
                                <h3 class="mb-1">100%</h3>
                                <p class="small text-muted mb-0">Satisfaction Rate</p>
                            </div>
                        </div>
                    </div>

                    <!-- Social Media Sidebar -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Connect With Us</h4>
                            <div class="d-flex justify-content-between">
                                <a href="#" class="social-icon text-dark">
                                    <i class="bi bi-facebook"></i>
                                </a>
                                <a href="#" class="social-icon text-dark">
                                    <i class="bi bi-instagram"></i>
                                </a>
                                <a href="#" class="social-icon text-dark">
                                    <i class="bi bi-twitter"></i>
                                </a>
                                <a href="#" class="social-icon text-dark">
                                    <i class="bi bi-linkedin"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-6">
                    <h2 class="mb-4">Ready to Get Started?</h2>
                    <p class="mb-4">Join thousands of satisfied customers who trust our products and services.</p>
                    <a href="#" class="btn btn-primary btn-lg">Contact Us Today</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section (for Contact Page) -->
    <div class="map-container d-none">
        <!-- Embed map here -->
        <div class="ratio ratio-21x9 h-100">
            <iframe src="about:blank" class="w-100 h-100" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
        </div>
    </div>


<?php
	include('pip_boy_MVC/wasteland_Views/footer.php');
	include('pip_boy_MVC/wasteland_Views/html_end.php');
?>