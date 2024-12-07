<?php
session_start();
include("../connections/connection.php");

if (isset($_POST['update_data'])) {
    $user_id = $_GET['user_id'];
    $fullname = $_POST['fullname'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $errors = array(); // Define an array to hold errors

    // Perform validation
    if (empty($fullname)) {
        $errors[] = "Fullname is required";
    }
    if (empty($address)) {
        $errors[] = "Address is required";
    }
    if (empty($phone)) {
        $errors[] = "Phone is required";
    }
    if (empty($email)) {
        $errors[] = "Email is required";
    }
    if (empty($password)) {
        $errors[] = "Password is required";
    }

    // If there are no errors, proceed with the update
    if (empty($errors)) {
        $update_user = "UPDATE user SET fullname='$fullname', address='$address', phone='$phone', email='$email', password='$password'
        WHERE user_id = '$user_id'";

        if (mysqli_query($connect, $update_user)) {
            // Set user addition status
            $userStatus = "User updated successfully";
        } else {
            // Set role addition status
            $userStatus = "Error occurred while updating User";
        }
    } else {
        // If there are errors, display them
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Tuos media</title>
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
            Content body start here
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">

                <!-- row -->
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">
                        <div class="card shadow">
                            <div class="card-header">
                                <h4 class="card-title">Custom Form</h4>
                            </div>

                            <?php if (!empty($userStatus)) : ?>
                                <div class="alert <?php echo strpos($userStatus, 'successfully') !== false ? 'alert-primary' : 'alert-primary'; ?>" id="successMessage" style="color:white">
                                    <?php echo $userStatus; ?>
                                </div>
                            <?php endif; ?>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form method="POST" onsubmit="return validateForm()">
                                        <?php
                                        $select_user = "SELECT * FROM user WHERE user_id = '" . $_GET['user_id'] . "'";
                                        $result = mysqli_query($connect, $select_user);
                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label" style="color: #001F3F;">Fullname</label>
                                                    <div class="col-sm-10">
                                                        <input name="fullname" id="fullname" type="text" class="form-control" style="height: 50px;" value="<?php echo $row['fullname'] ?>">
                                                        <div class="error" id="fullnameError"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label" style="color: #001F3F;">Address</label>
                                                    <div class="col-sm-10">
                                                        <input name="address" id="address" type="text" class="form-control" value="<?php echo $row['address'] ?>" style="height: 50px;">
                                                        <div class="error" id="addressError"></div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label" style="color: #001F3F;">Phone</label>
                                                    <div class="col-sm-10">
                                                        <input name="phone" id="phone" type="number" class="form-control" value="<?php echo $row['phone'] ?>" style="height: 50px;">
                                                        <div class="error" id="phoneError"></div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label" style="color: #001F3F;">Email</label>
                                                    <div class="col-sm-10">
                                                        <input name="email" id="email" type="email" class="form-control" value="<?php echo $row['email'] ?>" style="height: 50px;">
                                                        <div class="error" id="emailError"></div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label" style="color: #001F3F;">Password</label>
                                                    <div class="col-sm-10">
                                                        <input name="password" id="password" type="password" class="form-control" value="<?php echo $row['password'] ?>" style="height: 50px;">
                                                        <div class="error" id="passwordError"></div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-sm-10">
                                                        <button type="submit" name="update_data" class="btn btn" style=" background-color:#001F3F;">
                                                            Submit</button>
                                                        <span><a href="./allDoners.php"><button type="button" class="btn btn-danger">Cancel</button></a></span>
                                                    </div>
                                                </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </form>
                                </div>
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
        // Function to hide the success message after 2 seconds
        setTimeout(function() {
            var successMessage = document.getElementById('successMessage');
            if (successMessage) {
                successMessage.style.display = 'none'; // Hide the message
            }
        }, 2000);
    </script>

    <script>
        function validateForm() {
            var fullname = document.getElementById('fullname').value.trim();
            var address = document.getElementById('address').value.trim();
            var phone = document.getElementById('phone').value.trim();
            var email = document.getElementById('email').value.trim();
            var password = document.getElementById('password').value.trim();

            var isValid = true;

            // Clear previous error messages
            document.getElementById('fullnameError').textContent = '';
            document.getElementById('addressError').textContent = '';
            document.getElementById('phoneError').textContent = '';
            document.getElementById('emailError').textContent = '';
            document.getElementById('passwordError').textContent = '';

            if (fullname === '') {
                document.getElementById('fullnameError').textContent = 'Fullname is required';
                isValid = false;
            }
            if (address === '') {
                document.getElementById('addressError').textContent = 'Address is required';
                isValid = false;
            }
            if (phone === '') {
                document.getElementById('phoneError').textContent = 'Phone is required';
                isValid = false;
            }
            if (email === '') {
                document.getElementById('emailError').textContent = 'Email is required';
                isValid = false;
            }
            if (password === '') {
                document.getElementById('passwordError').textContent = 'Password is required';
                isValid = false;
            }

            return isValid;
        }
    </script>
</body>

</html>