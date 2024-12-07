<?php
session_start();
include '../../connections/connection.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Tous Media</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../assets/img/favicon.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">


</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center">

            <p class="logo me-auto" style="width:400px"><a href="index.html">TOUS MEDIA PRODUCTION</a></h1>
            <p style="color: white;font-size: 25px">
                Wellcome! <?php echo isset($_SESSION['fullname']) ? $_SESSION['fullname'] : ''; ?></p>

                <a href="../logout.php" class="get-started-btn">LOG OUT</a>

        </div>
    </header><!-- End Header -->

    <main id="main">
        <!-- ======= Breadcrumbs ======= -->



        <!-- ======= About Section ======= -->
        <section id="about" class="about" style="margin-top: 50px;">
            <div class="container shadow" data-aos="fade-up" style="margin-top: 10px;">
                <?php
                // Initialize the counter
                $select_camp = "SELECT * FROM camp   ORDER  BY camp_id DESC";
                $result = mysqli_query($connect, $select_camp) or die(mysqli_error($connect));
                $number = mysqli_num_rows($result);
                if ($number > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <div class="row">
                            <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
                                <img src="">
                                <!-- Assuming $row['image'] contains the filename of the image -->
                                <?php
                                // Check if $row['image'] is set and not empty
                                if (isset($row['image']) && !empty($row['image'])) {
                                    // Construct the path to the image
                                    $imagePath = "../camp/uploads/" . $row['image'];
                                ?>
                                    <!-- Display the image using PHP -->
                                    <img src="<?php echo $imagePath; ?>" class="img-fluid" alt="" style="height: 400px;">
                                <?php
                                } else {
                                    // If the image is not available, you can display a placeholder image or some default content
                                    echo "Image not available";
                                }
                                ?>





                            </div>
                            <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
                                <h3>
                                    Service name: <?php echo $row['camp_name']; ?>
                                </h3>
                                <p class="fst-italic">
                                    Location:<?php echo $row['location']; ?>
                                </p>
                                <ul>
                                    <li><i class="bi bi-check-circle"></i>
                                        <b> Our service Details:</b>

                                        <?php echo $row['description']; ?>



                                        .
                                    </li><br>

                                    <li><i class="bi bi-check-circle"></i>
                                        <b> Our service provision:</b>
                                        <?php echo $row['needs']; ?><br>

                                </ul>
                                <p>
                                    <b>CONTACT NUMBER: </b><?php echo $row['donate_number']; ?>
                                </p>

                            </div>
                            <hr style="color: #094469"><br>
                        </div>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='5'>0 results</td></tr>";
                }
                ?>
            </div>

        </section><!-- End About Section -->
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" style="margin-top: 60px;">

        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-md-6 footer-contact">
                        <h3 style="color: white;">TOUS MEDIA</h3>
                        <p style="color: white;">
                            Morogoro - Tanzania<br>
                            <strong>Phone:</strong> +255 672488849<br>
                            <strong>Email:</strong> Tousmedia234@gmail.com<br>
                        </p>
                    </div>

                    <div class="col-lg-2 col-md-6 footer-links">
                        <h4 style="color: white;">Useful Links</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">
                                    <h4 style="color: white;">Home</h4>
                                </a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">
                                    <h4 style="color: white;">About us</h4>
                                </a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">
                                    <h4 style="color: white;">Our service</h4>
                                </a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">
                                    <h4 style="color: white;">Events</h4>
                                </a></li>

                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4 style="color: white;">Our Vision</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i>
                                <a href="#">
                                    <h4 style="color: white;">Building Community</h4>
                                </a>
                            </li>
                            <li><i class="bx bx-chevron-right"></i>
                                <a href="/fontend/events.php">
                                    <h4 style="color: white;">Tuos Events</h4>
                                </a>
                            </li>
                            <li><i class="bx bx-chevron-right"></i>
                                <a href="#">
                                    <h4 style="color: white;">Connect people's needs</h4>
                                </a>
                            </li>
                            <li><i class="bx bx-chevron-right"></i>
                                <a href="#">
                                    <h4 style="color: white;">Ensuring Socilalisations</h4>
                                </a>
                            </li>

                        </ul>
                    </div>

                    <div class="col-lg-4 col-md-6 footer-newsletter">
                        <h4 style="color: white;">Join us</h4>
                        <p style="color: white;">Come closser with us for Tous production</p>

                    </div>

                </div>
            </div>
        </div>


    </footer><!-- End Footer -->

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="../assets/vendor/aos/aos.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>

</body>

</html>