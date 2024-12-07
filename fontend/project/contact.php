<?php
session_start();
include '../../connections/connection.php'; // Ensure this file establishes the $connect variable

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

$message = "";

if (isset($_POST['add_message'])) {
    // Sanitize input data
    $fullname = mysqli_real_escape_string($connect, $_POST['fullname']);
    $location = mysqli_real_escape_string($connect, $_POST['location']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $messages = mysqli_real_escape_string($connect, $_POST['message']);

    // Validate required fields
    if (!empty($fullname) && !empty($location) && !empty($email) && !empty($messages)) {
        $insert_new_message = "INSERT INTO message (fullname, location, email, messange) 
                               VALUES ('$fullname', '$location', '$email', '$messages')";

        // Execute query and handle errors
        if (mysqli_query($connect, $insert_new_message)) {
            $message = "Message submitted successfully.";
        } else {
            $message = "Message submission failed: " . mysqli_error($connect);
        }
    } else {
        $message = "All fields are required.";
    }
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

  <!-- Bootstrap CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="css/tiny-slider.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <title>Amaryzooh Company.com</title>
</head>

<body>

<!-- Start Header/Navigation -->
<nav class="custom-navbar navbar navbar-expand-md navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.html">Amaryzooh<span>.</span></a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsFurni">
      <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
        <li class="nav-item"><a class="nav-link" href="../../fontend/project/home.php">Home</a></li>
        <li><a class="nav-link" href="../../fontend/project/about.php">About us</a></li>
        <li><a class="nav-link" href="../../fontend/project/services.php">Services</a></li>
        <li><a class="nav-link" href="../../fontend/project/blog.php">Blog</a></li>
        <li class="active"><a class="nav-link" href="../../fontend/project/contact.php">Contact us</a></li>
        <li><a class="nav-link" href="../../backend/login.php">Shop</a></li>
      </ul>
    </div>
  </div>
</nav>
<!-- End Header/Navigation -->

<!-- Start Contact Form -->
<div class="untree_co-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-8 pb-4">
        <h2>Contact Us</h2>

        <!-- Display Message -->
        <?php if (!empty($message)): ?>
          <div class="alert alert-info"><?php echo $message; ?></div>
        <?php endif; ?>

        <form action="contact.php" method="post">
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label class="text-black" for="fname">Full name</label>
                <input type="text" class="form-control" id="fname" name="fullname" required>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label class="text-black" for="lname">Location</label>
                <input type="text" class="form-control" id="lname" name="location" required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="text-black" for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>

          <div class="form-group mb-5">
            <label class="text-black" for="message">Message</label>
            <textarea name="message" class="form-control" id="message" cols="30" rows="5" required></textarea>
          </div>

          <button type="submit" name="add_message" class="btn btn-primary-hover-outline">Send Message</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End Contact Form -->

<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/tiny-slider.js"></script>
<script src="js/custom.js"></script>

</body>
</html>
