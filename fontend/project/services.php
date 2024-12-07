<?php
session_start();
include '../../connections/connection.php';
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Amaryzooh">
    <meta name="description" content="Amaryzooh - Redefining Quality and Elegance">
    <meta name="keywords" content="Amaryzooh, furniture, interior design, luxury, shop">
    <link rel="shortcut icon" href="images/favicon.png">
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="css/tiny-slider.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <title>Amaryzooh - Company</title>
</head>

<body>
    <!-- Navigation -->
    <nav class="custom-navbar navbar navbar-expand-md navbar-dark bg-dark" aria-label="Amaryzooh Navigation">
        <div class="container">
            <a class="navbar-brand" href="index.php">Amaryzooh<span>.</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                    <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="services.php">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="blog.php">Blog</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="shop.php">Shop</a></li>
                </ul>
                <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                    <li><a class="nav-link" href="#"><img src="images/user.svg" alt="User"></a></li>
                    <li><a class="nav-link" href="cart.html"><img src="images/cart.svg" alt="Cart"></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Hero Section -->
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-6">
                    <div class="intro-excerpt">
                        <h1>Welcome to Amaryzooh</h1>
                        <p class="mb-4">Discover timeless elegance, curated designs, and unparalleled quality in every product.</p>
                        <p>
                            <a href="shop.php" class="btn btn-secondary me-2">Shop Now</a>
                            <a href="about.php" class="btn btn-outline-light">Learn More</a>
                        </p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-img-wrap">
                        <img src="images/couch.png" alt="Hero Image" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Why Choose Us Section -->
    <div class="why-choose-section py-5 bg-light">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4">
                    <div class="feature">
                        <img src="images/truck.svg" alt="Fast Shipping" class="img-fluid mb-3">
                        <h3>Fast Shipping</h3>
                        <p>Swift delivery right to your doorstep.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature">
                        <img src="images/support.svg" alt="Customer Support" class="img-fluid mb-3">
                        <h3>24/7 Support</h3>
                        <p>We're here to help anytime.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature">
                        <img src="images/return.svg" alt="Easy Returns" class="img-fluid mb-3">
                        <h3>Easy Returns</h3>
                        <p>Hassle-free returns for peace of mind.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Products Section -->
    <div class="product-section">
        <div class="container">
            <h2 class="text-center mb-5">Our Featured Products</h2>
            <div class="row">
                <!-- Product Card -->
                <div class="col-md-4">
                    <div class="product-item">
                        <img src="images/product-1.png" alt="Product 1" class="img-fluid mb-3">
                        <h3>Nordic Chair</h3>
                        <p class="price">$50.00</p>
                    </div>
                </div>
                <!-- Product Card -->
                <div class="col-md-4">
                    <div class="product-item">
                        <img src="images/product-2.png" alt="Product 2" class="img-fluid mb-3">
                        <h3>Kruzo Aero Chair</h3>
                        <p class="price">$78.00</p>
                    </div>
                </div>
                <!-- Product Card -->
                <div class="col-md-4">
                    <div class="product-item">
                        <img src="images/product-3.png" alt="Product 3" class="img-fluid mb-3">
                        <h3>Ergonomic Chair</h3>
                        <p class="price">$43.00</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="footer-section bg-dark text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>About Amaryzooh</h5>
                    <p>Your destination for premium quality and style. Join us as we redefine living spaces.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">Terms & Conditions</a></li>
                        <li><a href="#" class="text-white">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
            <div class="text-center mt-3">
                <p>&copy; 2024 Amaryzooh. All Rights Reserved.</p>
            </div>
        </div>
    </footer>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/tiny-slider.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>
