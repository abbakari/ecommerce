<?php
session_start();
include '../../connections/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productName = $_POST['productName'];
    $productPrice = $_POST['productPrice'];
    $customerName = $_POST['customerName'];
    $customerEmail = $_POST['customerEmail'];
    $customerAddress = $_POST['customerAddress'];
    $paymentMethod = $_POST['paymentMethod'];
    $customerComments = $_POST['customerComments'];
    $location = $_POST['location'];

    // Process payment based on the payment method
    // This is a placeholder. Replace with actual payment processing logic.
    if ($paymentMethod == 'credit_card') {
        // Implement credit card processing
    } elseif ($paymentMethod == 'paypal') {
        // Implement PayPal processing
    } elseif ($paymentMethod == 'mobile_money') {
        // Implement Mobile Money processing
    }

    // Save order details to the database
    $query = "INSERT INTO orders (product_name, product_price, customer_name, customer_email, customer_address, payment_method, comments, location) 
              VALUES ('$productName', '$productPrice', '$customerName', '$customerEmail', '$customerAddress', '$paymentMethod', '$customerComments', '$location')";
    
    if (mysqli_query($connect, $query)) {
        echo "Order submitted successfully!";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($connect);
    }

    // Redirect or show a confirmation page
    header('Location: confirmation.php');
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Untree.co">
  <link rel="shortcut icon" href="favicon.png">
  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap4" />
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="css/tiny-slider.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <title>Amaryzooh Company</title>

  <style>
    /* Popup form styling */
    .popup-form {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: white;
      padding: 20px;
      border: 1px solid #ccc;
      z-index: 1000;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
    }
    .popup-overlay {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      z-index: 999;
    }
  </style>
</head>

<body>
  <!-- Start Header/Navigation -->
  <nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">
    <div class="container">
      <a class="navbar-brand" style="color:blue;" href="">Amaryzooh.<span>.</span></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarsFurni">
        <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
          <li class="nav-item "><a class="nav-link" href="../../fontend/project/home.php">Home</a></li>
          <li class="active"><a class="nav-link" href="../../fontend/project/shop.php">Shop</a></li>
          <li><a class="nav-link" href="../../fontend/project/about.php">About us</a></li>
          <li><a class="nav-link" href="../../fontend/project/services.php">Services</a></li>
          <li><a class="nav-link" href="../../fontend/project/blog.php">Blog</a></li>
          <li><a class="nav-link" href="../../fontend/project/contact.php">Contact us</a></li>
          <li><a class="nav-link" href="../../backend/login.php">shop now</a></li>
        </ul>
    
      </div>
    </div>
  </nav>
  <!-- End Header/Navigation -->

  <!-- Start Hero Section -->
  <div class="hero">
    <div class="container">
      <div class="row justify-content-between">
        <div class="col-lg-5">
          <div class="intro-excerpt">
            <h1>Shop</h1>
          </div>
        </div>
        <div class="col-lg-7"></div>
      </div>
    </div>
  </div>
  <!-- End Hero Section -->

  <div class="untree_co-section product-section before-footer-section">
    <div class="container">
      <div class="row">
        <?php
        $products = [
          ["name" => "Nordic Chair", "price" => 50.00, "image" => "images/product-3.png"],
          ["name" => "Kruzo Aero Chair", "price" => 78.00, "image" => "images/product-2.png"],
          ["name" => "Ergonomic Chair", "price" => 43.00, "image" => "images/product-3.png"],
          // Add more products as needed
        ];
        foreach ($products as $product) {
          echo '<div class="col-12 col-md-4 col-lg-3 mb-5">';
          echo '<a class="product-item" href="#" onclick="openPopup(\''.htmlspecialchars(json_encode($product)).'\')">';
          echo '<img src="'.$product['image'].'" class="img-fluid product-thumbnail">';
          echo '<h3 class="product-title">'.$product['name'].'</h3>';
          echo '<strong class="product-price">$'.$product['price'].'</strong>';
          echo '<span class="icon-cross"><img src="images/cross.svg" class="img-fluid"></span>';
          echo '</a>';
          echo '</div>';
        }
        ?>
      </div>
    </div>
  </div>
<!-- Popup Form -->
<div class="popup-overlay" id="popupOverlay" onclick="closePopup()"></div>
<div class="popup-form" id="popupForm">
  <form action="shop.php" method="POST">
    <h4 id="productName"></h4>
    <input type="hidden" id="productNameInput" name="productName">
    <input type="hidden" id="productPriceInput" name="productPrice">
    
    <div class="form-group">
      <label for="customerName">Your Name:</label>
      <input type="text" class="form-control" id="customerName" name="customerName" required>
    </div>
    
    <div class="form-group">
      <label for="customerEmail">Your Email:</label>
      <input type="email" class="form-control" id="customerEmail" name="customerEmail" required>
    </div>
    
    <div class="form-group">
      <label for="customerAddress">Your Address:</label>
      <textarea class="form-control" id="customerAddress" name="customerAddress" required></textarea>
    </div>

    <div class="form-group">
      <label for="paymentMethod">Payment Method:</label>
      <select class="form-control" id="paymentMethod" name="paymentMethod" required>
        <option value="credit_card">Credit Card</option>
        <option value="paypal">PayPal</option>
        <option value="mobile_money">Mobile Money</option>
		<option value="mobile_money">Call for more information:<br>
	            +255 0742710426                   </option>

        <!-- Add more payment options as needed -->
      </select>
    </div>

    <div class="form-group">
      <label for="customerComments">Comments:</label>
      <textarea class="form-control" id="customerComments" name="customerComments"></textarea>
    </div>
    
    <div class="form-group">
      <label for="location">Location:</label>
      <input type="text" class="form-control" id="location" name="location" required>
    </div>
    
    <button type="submit" class="btn btn-primary">Submit Order</button>
    <button type="button" class="btn btn-secondary" onclick="closePopup()">Cancel</button>
  </form>
</div>

  <!-- Start Footer Section -->
  <footer class="footer-section">
    <div class="container relative">
      <div class="sofa-img"><img src="images/sofa.png" alt="Image" class="img-fluid"></div>
      <div class="row">
        <div class="col-lg-8">
          <div class="subscription-form">
            <h3 class="d-flex align-items-center">
              <span class="me-1"><img src="images/envelope-outline.svg" alt="Image" class="img-fluid"></span>
              <span>Subscribe to Newsletter</span>
            </h3>
            <form action="#" class="row g-3">
              <div class="col-auto">
                <input type="text" class="form-control" placeholder="Enter your name">
              </div>
              <div class="col-auto">
                <input type="email" class="form-control" placeholder="Enter your email">
              </div>
              <div class="col-auto">
                <button class="btn btn-primary"><span class="fa fa-paper-plane"></span></button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="row g-5 mb-5">
        <div class="col-lg-4">
          <div class="mb-4 footer-logo-wrap"><a href="#" class="footer-logo">Amaryzooh.com<span>.</span></a></div>
          <p class="mb-4">Join Us Shop with Amaryzooh.com...</p>
          <ul class="list-unstyled custom-social">
            <li><a href="#"><span class="fa fa-brands fa-facebook-f"></span></a></li>
            <li><a href="#"><span class="fa fa-brands fa
			         <li><a href="#"><span class="fa fa-brands fa-facebook-f"></span></a></li>
            <li><a href="#"><span class="fa fa-brands fa-twitter"></span></a></li>
            <li><a href="#"><span class="fa fa-brands fa-instagram"></span></a></li>
            <li><a href="#"><span class="fa fa-brands fa-linkedin"></span></a></li>
          </ul>
        </div>
        <div class="col-lg-8">
          <div class="row links-wrap">
            <div class="col-6 col-sm-6 col-md-3">
              <ul class="list-unstyled">
                <li><a href="#">About us</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">Contact us</a></li>
              </ul>
            </div>
            <div class="col-6 col-sm-6 col-md-3">
              <ul class="list-unstyled">
                <li><a href="#">Support</a></li>
                <li><a href="#">Knowledge base</a></li>
                <li><a href="#">Careers</a></li>
              </ul>
            </div>
            <div class="col-6 col-sm-6 col-md-3">
              <ul class="list-unstyled">
                <li><a href="#">Refund policy</a></li>
                <li><a href="#">Terms of service</a></li>
                <li><a href="#">Privacy policy</a></li>
              </ul>
            </div>
            <div class="col-6 col-sm-6 col-md-3">
              <ul class="list-unstyled">
                <li><a href="#">Shipping policy</a></li>
                <li><a href="#">Sitemap</a></li>
                <li><a href="#">Affiliates</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="border-top pt-5">
        <div class="row">
          <div class="col-md-6 text-center text-md-start">
            <p class="mb-0">&copy; 2024 Amaryzooh Company. All rights reserved.</p>
          </div>
          <div class="col-md-6 text-center text-md-end">
            <p class="mb-0">Designed with <span class="fa fa-heart"></span> by <a href="#">Amaryzooh Company</a></p>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- End Footer Section -->

  <script src="js/jquery-3.6.0.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/tiny-slider.js"></script>
  <script src="js/flatpickr.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/glightbox.min.js"></script>
  <script src="js/nouislider.min.js"></script>
  <script src="js/main.js"></script>

  <script>
    function openPopup(productData) {
      const product = JSON.parse(productData);
      document.getElementById('productName').innerText = product.name;
      document.getElementById('productNameInput').value = product.name;
      document.getElementById('productPriceInput').value = product.price;
      document.getElementById('popupOverlay').style.display = 'block';
      document.getElementById('popupForm').style.display = 'block';
    }

    function closePopup() {
      document.getElementById('popupOverlay').style.display = 'none';
      document.getElementById('popupForm').style.display = 'none';
    }
  </script>
</body>
</html>