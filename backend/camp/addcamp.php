<?php
session_start();
include("../connections/connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {

    $name = $_POST["camp_name"];
    $location = $_POST["location"];
    $description = $_POST["description"];
    $needs = $_POST["needs"];
    $phone = $_POST["donate_number"];
    $targetDir = "uploads/";
    $fileName = basename($_FILES["image"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Check if image file is a actual image or fake image
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
    if (in_array($fileType, $allowTypes)) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            // Use prepared statement to prevent SQL injection
            $sql = "INSERT INTO camp (camp_name, location, description, needs, donate_number, image) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $connect->prepare($sql);
            $stmt->bind_param("ssssss", $name, $location, $description, $needs, $phone, $fileName);
            if ($stmt->execute()) {
                // Redirect to the same page with a success message
                $_SESSION['success_message'] = "Camp details added successfully.";
                header("location: addcamp.php");
                exit(); // Add exit to prevent further execution of the script
            } else {
                echo "Error: " . $sql . "<br>" . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Tuos Media</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <!-- Custom Stylesheet -->
    <link href="./themes/css/style.css" rel="stylesheet">

    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">
        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a class="brand-logo">
                TUOS MEDIA
            </a>
            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->
        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end here
        ***********************************-->
        <!--**********************************
            Sidebar start here
        ***********************************-->
        <div class="quixnav">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                    <li><a class="has-arrow" href="../Admin/dashboard.php" aria-expanded="false"><i class="icon icon-home"></i><span class="nav-text">DASHBOARD</span></a>

                    </li>



                    <li class="nav-label first">Main Menu</li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="icon icon-app-store"></i><span class="nav-text">ROLES</span></a>
                        <ul aria-expanded="false">
                            <li><a href="../role/allRoles.php">View_All</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="icon icon-app-store"></i><span class="nav-text">DONORS</span></a>
                        <ul aria-expanded="false">
                            <li><a href="../donors/allDoners.php">View_All</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="icon icon-app-store"></i><span class="nav-text">CAMPS</span></a>
                        <ul aria-expanded="false">
                            <li><a href="../camp/allcamps.php">View_All</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end here
        ***********************************-->
        <!--**********************************
            Content body start here
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <!-- row -->
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">
                        <div class="card shadow">
                            <div class="card-header">
                                <h4 class="card-title">Service Details Form</h4>
                            </div>
                            <?php
                            // Display success message if it exists
                            if (isset($_SESSION['success_message'])) {
                                echo '<div class="alert alert-primary" style="color:white">' . $_SESSION['success_message'] . '</div>';
                                unset($_SESSION['success_message']); // Clear the success message
                            }
                            ?>

                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="" method="post" enctype="multipart/form-data" name="campForm" onsubmit="return validateForm()">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" style="color: #001F3F;">Service
                                                Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="camp_name" class="form-control" placeholder="Enter Camp Name" style="height: 50px;">
                                                <div id="campNameError" class="error"></div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" style="color: #001F3F;">Location</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="location" class="form-control" placeholder="Enter Location" style="height: 50px;">
                                                <div id="locationError" class="error"></div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" style="color: #001F3F;">Description</label>
                                            <div class="col-sm-10">
                                                <textarea name="description" id="description" class="form-control" style="height: 100px;" placeholder="Provide Camp Descriptions"></textarea>
                                                <div id="descriptionError" class="error"></div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" style="color: #001F3F;">service</label>
                                            <div class="col-sm-10">
                                                <textarea name="needs" id="needs" class="form-control" style="height: 100px;" placeholder="Provide Camp Needs"></textarea>
                                                <div id="needsError" class="error"></div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" style="color: #001F3F;">Phone</label>
                                            <div class="col-sm-10">
                                                <input type="number" name="donate_number" class="form-control" placeholder="Enter donation number" style="height: 50px;">
                                                <div id="phoneError" class="error"></div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" style="color: #001F3F;">Image</label>
                                            <div class="col-sm-10">
                                                <input type="file" name="image" class="form-control-file" style="height: 50px;">
                                                <!-- You can add accept attribute to specify allowed file types, for example: accept="image/*" -->
                                                <div id="imageError" class="error"></div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <button type="submit" name="submit" class="btn btn" style="background-color:#001F3F;">Submit</button>
                                                <span><a href="./allcamps.php"><button type="button" class="btn btn-danger">Cancel</button></a></span>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Required vendors -->
    <script src="./themes/vendor/global/global.min.js"></script>
    <script src="./themes/js/quixnav-init.js"></script>
    <script src="./themes/js/custom.min.js"></script>
    <script>
        function validateForm() {
            var name = document.forms["campForm"]["camp_name"].value;
            var location = document.forms["campForm"]["location"].value;
            var description = document.forms["campForm"]["description"].value;
            var needs = document.forms["campForm"]["needs"].value;
            var phone = document.forms["campForm"]["donate_number"].value;
            var image = document.forms["campForm"]["image"].value;
            var isValid = true;
            if (name == "") {
                document.getElementById("campNameError").innerHTML = "Please enter the camp name.";
                isValid = false;
            } else {
                document.getElementById("campNameError").innerHTML = "";
            }
            if (location == "") {
                document.getElementById("locationError").innerHTML = "Please enter the location.";
                isValid = false;
            } else {
                document.getElementById("locationError").innerHTML = "";
            }
            if (description == "") {
                document.getElementById("descriptionError").innerHTML = "Please provide camp descriptions.";
                isValid = false;
            } else {
                document.getElementById("descriptionError").innerHTML = "";
            }
            if (needs == "") {
                document.getElementById("needsError").innerHTML = "Please provide camp needs.";
                isValid = false;
            } else {
                document.getElementById("needsError").innerHTML = "";
            }
            if (phone == "") {
                document.getElementById("phoneError").innerHTML = "Please enter donation number.";
                isValid = false;
            } else {
                document.getElementById("phoneError").innerHTML = "";
            }
            if (image == "") {
                document.getElementById("imageError").innerHTML = "Please select an image.";
                isValid = false;
            } else {
                document.getElementById("imageError").innerHTML = "";
            }
            return isValid;
        }
    </script>
</body>

</html>