<?php
session_start();
include("../connections/connection.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["camp_id"])) {
    $camp_id = $_GET["camp_id"];
    $sql = "SELECT * FROM camp WHERE camp_id = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i", $camp_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = isset($_POST["camp_name"]) ? $_POST["camp_name"] : $row["camp_name"];
        $location = isset($_POST["location"]) ? $_POST["location"] : $row["location"];
        $description = isset($_POST["description"]) ? $_POST["description"] : $row["description"];
        $needs = isset($_POST["needs"]) ? $_POST["needs"] : $row["needs"];
        $phone = isset($_POST["donate_number"]) ? $_POST["donate_number"] : $row["donate_number"];
        $image = $row["image"];
    }
}

// Handle form submission for update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    $camp_id = $_POST["camp_id"];
    $name = $_POST["camp_name"];
    $location = $_POST["location"];
    $description = $_POST["description"];
    $needs = $_POST["needs"];
    $phone = $_POST["donate_number"];

    // Check if a new image file is uploaded
    if ($_FILES["image"]["name"]) {
        $image_name = $_FILES["image"]["name"];
        $temp_image_name = $_FILES["image"]["tmp_name"];
        $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);
        $allowed_extensions = array("jpg", "jpeg", "png", "gif");

        // Check if the uploaded file is an image
        if (in_array($image_extension, $allowed_extensions)) {
            // Generate a unique name for the image
            $unique_image_name = uniqid("camp_") . "." . $image_extension;

            // Move the uploaded image to the desired directory
            if (move_uploaded_file($temp_image_name, "uploads/" . $unique_image_name)) {
                // Update the database with the new image name using prepared statement
                $sql = "UPDATE camp SET camp_name=?, location=?, description=?, needs=?, donate_number=?, image=? WHERE camp_id=?";
                $stmt = $connect->prepare($sql);
                $stmt->bind_param("ssssssi", $name, $location, $description, $needs, $phone, $unique_image_name, $camp_id);
                if ($stmt->execute()) {
                    echo "Record updated successfully. <a href='allSymbols.php'>Go back</a>";
                } else {
                    echo "Error updating record: " . $connect->error;
                }
            } else {
                echo "Error uploading image.";
            }
        } else {
            echo "Invalid file format. Please upload an image.";
        }
    } else {
        // If no new image uploaded, only update other details using prepared statement
        $sql = "UPDATE camp SET camp_name=?, location=?, description=?, needs=?, donate_number=? WHERE camp_id=?";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("sssssi", $name, $location, $description, $needs, $phone, $camp_id);
        if ($stmt->execute()) {
            echo "Record updated successfully. <a href='allSymbols.php'>Go back</a>";
        } else {
            echo "Error updating record: " . $connect->error;
        }
    }
    // Set success message and redirect
    $_SESSION['success_message'] = "Record updated successfully.";
    header("Location: {$_SERVER['PHP_SELF']}?camp_id=$camp_id");
    exit();
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
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="icon icon-app-store"></i><span class="nav-text">CUSTOMERS</span></a>
                        <ul aria-expanded="false">
                            <li><a href="../donors/allDoners.php">View_All</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="icon icon-app-store"></i><span class="nav-text">SERVICES</span></a>
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
                                        <input type="hidden" name="camp_id" value="<?php echo isset($camp_id) ? $camp_id : ''; ?>">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" style="color: #001F3F;">Service
                                                Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="camp_name" class="form-control" value="<?php echo isset($name) ? $name : ''; ?>" style="height: 50px;">
                                                <div id="campNameError" class="error"></div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" style="color: #001F3F;">Location</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="location" class="form-control" value="<?php echo isset($location) ? $location : ''; ?>" style="height: 50px;">
                                                <div id="locationError" class="error"></div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" style="color: #001F3F;">Description</label>
                                            <div class="col-sm-10">
                                                <textarea name="description" id="description" class="form-control" style="height: 100px;" placeholder="Provide Camp Descriptions"><?php echo isset($description) ? $description : ''; ?></textarea>
                                                <div id="descriptionError" class="error"></div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" style="color: #001F3F;">services</label>
                                            <div class="col-sm-10">
                                                <textarea name="needs" id="needs" class="form-control" style="height: 100px;" placeholder="Provide Camp Needs"><?php echo isset($needs) ? $needs : ''; ?></textarea>
                                                <div id="needsError" class="error"></div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" style="color: #001F3F;">Phone</label>
                                            <div class="col-sm-10">
                                                <input type="number" name="donate_number" class="form-control" value="<?php echo isset($phone) ? $phone : ''; ?>" style="height: 50px;">
                                                <div id="phoneError" class="error"></div>
                                            </div>
                                        </div>
                                        <!-- Inside the form -->
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" style="color: #001F3F;">Image</label>
                                            <div class="col-sm-10">
                                                <input type="file" name="image" class="form-control" style="height: 50px;">
                                                <img src="uploads/<?php echo $image; ?>" alt="Current Image" style="max-width: 200px; max-height: 200px;">

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <button type="submit" name="update" class="btn btn" style="background-color:#001F3F;">Update</button>
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

            var isValid = true;
            if (name.trim() === "") {
                document.getElementById("campNameError").innerHTML = "Please enter the camp name.";
                isValid = false;
            } else {
                document.getElementById("campNameError").innerHTML = "";
            }
            if (location.trim() === "") {
                document.getElementById("locationError").innerHTML = "Please enter the location.";
                isValid = false;
            } else {
                document.getElementById("locationError").innerHTML = "";
            }
            if (description.trim() === "") {
                document.getElementById("descriptionError").innerHTML = "Please provide camp descriptions.";
                isValid = false;
            } else {
                document.getElementById("descriptionError").innerHTML = "";
            }
            if (needs.trim() === "") {
                document.getElementById("needsError").innerHTML = "Please provide camp needs.";
                isValid = false;
            } else {
                document.getElementById("needsError").innerHTML = "";
            }
            if (phone.trim() === "") {
                document.getElementById("phoneError").innerHTML = "Please enter donation number.";
                isValid = false;
            } else {
                document.getElementById("phoneError").innerHTML = "";
            }
            return isValid;
        }
    </script>
</body>

</html>