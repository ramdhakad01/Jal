<?php
session_start(); // Start the session

// Check if session exists (user is logged in)
if (!isset($_SESSION['email'])) {
    header("Location: index.html"); // Redirect to login page if not logged in
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Jal Wala</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wdth,wght@0,75..100,300..800;1,75..100,300..800&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- main Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <!-- bottle css -->
    <link rel="stylesheet" href="css/bottle.css">
</head>

<body>

    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->
    
    <!-- Navbar & Hero Start -->
    <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
            <a href="" class="navbar-brand p-0">
                <h1 class="text-primary"><i style="padding-right: 5px;"><img src="img/logo.webp" alt="Logo"
                            class="logo"></i>Jal Wala</h1>
                <!-- <img src="img/logo.webp" alt="Logo" class="logo"> -->
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="index.php" class="nav-item nav-link ">Home</a>
                    <a href="water_bottle.php" class="nav-item nav-link ">Water Bottles</a>
                    <a href="water_camper.php" class="nav-item nav-link ">Water Campers</a>
                    <a href="water_tanker.php" class="nav-item nav-link">Water Tankers</a>

                    <a href="registration.html" class=" nav-item nav-link">
                        <i class="fas fa-store"></i>
                        <span>Become a Seller</span>
                    </a>



                    <div class="nav-item dropdown cart-dropdown ">
                        <button class="dropdown-toggle nav-link" id="cartButton">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="dropdown-text">Cart</span>
                            <span class="cart-count" id="cartCount">0</span>
                        </button>
                        <div class="dropdown-menu cart-menu" id="cartMenu">
                            <!-- Cart content will be loaded here via JavaScript -->
                        </div>
                    </div>

                    <div class="nav-item dropdown active">
                        <a href="#" class="nav-link dropdown-toggle " data-bs-toggle="dropdown">Pages</a>
                        <div class="dropdown-menu m-0">
                            <a href="feature.php" class="dropdown-item">Our Feature</a>
                            <a href="product.php" class="dropdown-item">Our Product</a>
                            <a href="team.php" class="dropdown-item">Our Team</a>
                            <a href="testimonial.php" class="dropdown-item">Testimonial</a>
                            <a href="blog.php" class="dropdown-item">Blog</a>
                            <a href="about.php" class="dropdown-item">About</a>
                            <a href="contact.php" class="dropdown-item">Contact</a>
                        </div>
                    </div>
                </div>
             

                <div class="nav-item dropdown">
                    <button style="color: white;" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                        <i class="fas fa-user"></i>

                        <?php if (isset($_SESSION["email"])): ?>
                            <?php echo htmlspecialchars($_SESSION["email"]); ?>

                        <?php else: ?>
                            <p>Welcome, Guest!</p>
                            <a href="login.php">Please login</a>
                        <?php endif; ?>



                        </span>
                    </button>
                    <div class="dropdown-menu m-0">
                        <a href="profile.php">Profile</a>
                        <a href="order.html">Orders</a>
                        <a href="wishlist.php">Wishlist</a>
                        <div class="dropdown-divider"></div>
                        <a href="logout.php">Logout</a>
                    </div>
                </div>
                   <button class="btn btn-primary btn-md-square d-flex flex-shrink-0 mb-3 mb-lg-0 rounded-circle me-3"
                    data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fas fa-search"></i></button>
            </div>
        </nav>            <!-- Header Start -->

        <!-- Header Start -->
        <div class="container-fluid bg-breadcrumb">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">About Us</h4>
                <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active text-primary">About</li>
                </ol>
            </div>
        </div>
        <!-- Header End -->
    </div>
    <!-- Navbar & Hero End -->

    <!-- Modal Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h4 class="modal-title mb-0" id="exampleModalLabel">Search by keyword</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center">
                    <div class="input-group w-75 mx-auto d-flex">
                        <input type="search" class="form-control p-3" placeholder="keywords"
                            aria-describedby="search-icon-1">
                        <span id="search-icon-1" class="input-group-text btn border p-3"><i
                                class="fa fa-search text-white"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Search End -->

    <!-- About Start -->
    <div class="container-fluid about py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-xl-6 wow fadeInLeft" data-wow-delay="0.2s">
                    <div class="about-img rounded h-100">
                        <img src="img/about.jpg" class="img-fluid rounded h-100 w-100" style="object-fit: cover;"
                            alt="">
                        <div class="about-exp"><span>20 Years Experiance</span></div>
                    </div>
                </div>
                <div class="col-xl-6 wow fadeInRight" data-wow-delay="0.2s">
                    <div class="about-item">
                        <h4 class="text-primary text-uppercase">About Us</h4>
                        <h1 class="display-3 mb-3">We Deliver The Quality Water.</h1>
                        <p class="mb-4">Jal Wala specializes in delivering pure and reliable water solutions tailored to
                            your needs. Whether you require water bottles for convenience, water campers for events, or
                            water tankers for large-scale requirements, we ensure quality and trust in every drop. Your
                            satisfaction is our priority, as we strive to make access to clean water simple and
                            hassle-free."
                        </p>
                        <div class="bg-light rounded p-4 mb-4">
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex">
                                        <div class="pe-4">
                                            <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center"
                                                style="width: 80px; height: 80px;"><i
                                                    class="fas fa-tint text-white fa-2x"></i></div>
                                        </div>
                                        <div class="">
                                            <a href="#" class="h4 d-inline-block mb-3">Satisfied Customer</a>
                                            <p class="mb-0">At Jal Wala, customer satisfaction is at the heart of
                                                everything we do. We take pride in delivering not only high-quality
                                                water bottles, campers, and tankers but also exceptional service.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-light rounded p-4 mb-4">
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex">
                                        <div class="pe-4">
                                            <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center"
                                                style="width: 80px; height: 80px;"><i
                                                    class="fas fa-faucet text-white fa-2x"></i></div>
                                        </div>
                                        <div class="">
                                            <a href="#" class="h4 d-inline-block mb-3">Standard Product</a>
                                            <p class="mb-0">Jal Wala is dedicated to providing a range of standard water
                                                solutions, including premium-quality water bottles, durable water
                                                campers, and efficient water tankers.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="#" class="btn btn-secondary rounded-pill py-3 px-5">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Fact Counter -->
    <div class="container-fluid counter py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="counter-item">
                        <div class="counter-item-icon mx-auto">
                            <i class="fas fa-thumbs-up fa-3x text-white"></i>
                        </div>
                        <h4 class="text-white my-4">Happy Clients</h4>
                        <div class="counter-counting">
                            <span class="text-white fs-2 fw-bold" data-toggle="counter-up">456</span>
                            <span class="h1 fw-bold text-white">+</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="counter-item">
                        <div class="counter-item-icon mx-auto">
                            <i class="fas fa-truck fa-3x text-white"></i>
                        </div>
                        <h4 class="text-white my-4">Transport</h4>
                        <div class="counter-counting">
                            <span class="text-white fs-2 fw-bold" data-toggle="counter-up">513</span>
                            <span class="h1 fw-bold text-white">+</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.6s">
                    <div class="counter-item">
                        <div class="counter-item-icon mx-auto">
                            <i class="fas fa-users fa-3x text-white"></i>
                        </div>
                        <h4 class="text-white my-4">Employees</h4>
                        <div class="counter-counting">
                            <span class="text-white fs-2 fw-bold" data-toggle="counter-up">53</span>
                            <span class="h1 fw-bold text-white">+</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.8s">
                    <div class="counter-item">
                        <div class="counter-item-icon mx-auto">
                            <i class="fas fa-heart fa-3x text-white"></i>
                        </div>
                        <h4 class="text-white my-4">Years Experiance</h4>
                        <div class="counter-counting">
                            <span class="text-white fs-2 fw-bold" data-toggle="counter-up">17</span>
                            <span class="h1 fw-bold text-white">+</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fact Counter -->

    <!-- feature Start -->
    <div class="container-fluid feature bg-light py-5">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                <h4 class="text-uppercase text-primary">Our Feature</h4>
                <h1 class="display-3 text-capitalize mb-3">Water Bottles -> Water Campers -> Water Tankers</h1>
            </div>
            <div class="row g-4">
                <div class=" col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="feature-item p-4">
                        <div class="feature-icon mb-3"><i class="fas fa-hand-holding-water text-white fa-3x"></i></div>
                        <a href="#" class="h4 mb-3">Quality Check</a>
                        <p class="mb-3">At Jal Wala, monitors every drop using advanced testing protocols. This meets
                            the highest standards of purity, safety, and the perfect mineral
                            balance.
                        </p>
                        <a href="#" class="btn text-secondary">Read More <i class="fa fa-angle-right"></i></a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="feature-item p-4">
                        <div class="feature-icon mb-3"><i class="fas fa-filter text-white fa-3x"></i></div>
                        <a href="#" class="h4 mb-3">5 Steps Filtration</a>
                        <p class="mb-3">Jal wala ensures pure water by removing sediments, odors, contaminants,
                            pathogens, and enhancing taste for safe and clean drinking water.</p>
                        <a href="#" class="btn text-secondary">Read More <i class="fa fa-angle-right"></i></a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.6s">
                    <div class="feature-item p-4">
                        <div class="feature-icon mb-3"><i class="fas fa-recycle text-white fa-3x"></i></div>
                        <a href="#" class="h4 mb-3">Customer-Centric Approach</a>
                        <p class="mb-3">
                            Pure refreshment in every drop.
                            Advanced filtration removes all impurities.
                            Jal Wala delivers quality water you can trust.
                        </p>
                        <a href="#" class="btn text-secondary">Read More <i class="fa fa-angle-right"></i></a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.8s">
                    <div class="feature-item p-4">
                        <div class="feature-icon mb-3"><i class="fas fa-microscope text-white fa-3x"></i></div>
                        <a href="#" class="h4 mb-3">Purity Guaranteed</a>
                        <p class="mb-3"> Advanced filtration removes all impurities.
                            Balanced with essential minerals for optimal hydration. Jal Wala delivers safe, quality
                            water you can trust.</p>
                        <a href="#" class="btn text-secondary">Read More <i class="fa fa-angle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- feature End -->


    <!-- Footer Start -->
    <div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s">
        <div class="container py-5">
            <div class="row g-5 mb-5 align-items-center">
                <div class="col-lg-7">
                    <div class="position-relative mx-auto">
                        <input class="form-control rounded-pill w-100 py-3 ps-4 pe-5" type="text"
                            placeholder="Email address to Register ">
                            <a href="sing.html"><button type="button" class="btn btn-secondary rounded-pill position-absolute top-0 end-0 py-2 px-4 mt-2 me-2">Register</button></a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="d-flex align-items-center justify-content-center justify-content-lg-end">
                        <a class="btn btn-secondary btn-md-square rounded-circle me-3" href=""><i
                                class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-secondary btn-md-square rounded-circle me-3" href=""><i
                                class="fab fa-twitter"></i></a>
                        <a class="btn btn-secondary btn-md-square rounded-circle me-3" href=""><i
                                class="fab fa-instagram"></i></a>
                        <a class="btn btn-secondary btn-md-square rounded-circle me-0" href=""><i
                                class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
            <div class="row g-5">
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item d-flex flex-column">
                        <div class="footer-item">
                            <h3 class="text-white mb-4"><i class="fas text-primary me-3"
                                    style="padding-right: 3px;"><img src="img/logo.webp" alt="Logo" class="logo"></i>Jal
                                Wala</h3>
                            <p class="mb-3">Please connect with us for water supply service</p>
                        </div>
                        <div class="position-relative">
                            <input class="form-control rounded-pill w-100 py-3 ps-4 pe-5" type="text"
                                placeholder="Enter your email">
                            <button type="button"
                                class="btn btn-secondary rounded-pill position-absolute top-0 end-0 py-2 mt-2 me-2">Sign
                                In </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item d-flex flex-column">
                        <h4 class="text-white mb-4">About Us</h4>
                        <a href="#"><i class="fas fa-angle-right me-2"></i> Why Choose Us</a>
                        <a href="#"><i class="fas fa-angle-right me-2"></i>Water Bottles</a>
                        <a href="#"><i class="fas fa-angle-right me-2"></i>Water Campers</a>
                        <a href="#"><i class="fas fa-angle-right me-2"></i>Water Tankers </a>
                        <a href="#"><i class="fas fa-angle-right me-2"></i> Contact us</a>
                        <a href="#"><i class="fas fa-angle-right me-2"></i> Terms & Conditions</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item d-flex flex-column">
                        <h4 class="text-white mb-4">Contact Info</h4>
                        <a href="#"><i class="fa fa-map-marker-alt me-2"></i> Medicaps University, Indore MP</a>
                        <a href="mailto:info@example.com"><i class="fas fa-envelope me-2"></i>
                            dhakadram668@gmail.com</a>
                        <a href="mailto:info@example.com"><i class="fas fa-envelope me-2"></i>
                            en22ca301036@medicaps.ac.in</a>
                        <a href="#"><i class="fas fa-phone me-2"></i> +919294868008</a>
                        <a href="#" class="mb-3"><i class="fas fa-print me-2"></i> +919294868008</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Copyright Start -->
    <div class="container-fluid copyright py-4">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-md-6 text-center text-md-start mb-md-0">
                    <span class="text-body"><a href="#" class="border-bottom text-white"><i
                                class="fas fa-copyright text-light me-2"></i>Jal Wala</a>, All right reserved.</span>
                </div>
                <div class="col-md-6 text-center text-md-end text-body">
                    Designed By <a class="border-bottom text-white" href="#">Rambabu Dhakad, Mohit Mourya</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-secondary btn-lg-square rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>


    <!-- Javascript -->
    <script src="js/main.js"></script>
    <script src="js/cart.js"></script>
    <script src="js/bottle.js"></script>
</body>

</html>