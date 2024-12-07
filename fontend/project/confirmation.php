<?php
session_start();
include '../../connections/connection.php';
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Swiper CSS -->
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
  <title>Order Confirmation</title>
  <style>
    .swiper-container {
      width: 100%;
      height: 400px;
    }

    .swiper-slide {
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
    }

    .slide-info {
      position: absolute;
      bottom: 10px;
      left: 10px;
      background: rgba(0, 0, 0, 0.5);
      color: white;
      padding: 30px;
      border-radius: 20px;
    }

    .carousel-caption {
      bottom: 20px;
      left: 20px;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 text-center">
        <h1>Thank You for Your Order!</h1>
        <p>Your order has been submitted successfully. We will process it shortly.</p>
        <a href="../../fontend/project/shop.php" class="btn btn-primary">Continue Shopping</a>
      </div>
    </div>
  </div>

  <!-- Swiper Container -->
  <div class="swiper-container mt-5">
    <div class="swiper-wrapper">
      <!-- Slide 1 -->
      <div class="swiper-slide">
        <img src="../../fontend/project/images/img-grid-1.jpg" alt="Image 1" class="img-fluid"width="400" height="200">
        <div class="slide-info">
            <p>Amary :CO</p>
          <p>Advertise with us enjoy you momment!</p>
        </div>
      </div>
      <!-- Slide 2 -->
      <div class="swiper-slide">
        <video src="../../fontend/project/images/wedding v.jpg.mp4" class="img-fluid"width="500" height="300" controls></video>
        <div class="slide-info">
            <p>Amary .CO</p>
          <p>Amaryzooh company is ready for you</p>
        </div>
      </div>
      <!-- More slides as needed -->
    </div>
    <!-- Add Pagination -->
    <div class="swiper-pagination"></div>
    <!-- Add Navigation -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
  </div>

  <!-- Swiper JS -->
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  <!-- Bootstrap JS and dependencies -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    var swiper = new Swiper('.swiper-container', {
      loop: true,
      autoplay: {
        delay: 3000, // Change slide every 3 seconds
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
  </script>
</body>
</html>