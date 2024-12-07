<?php
session_start();
include '../connections/connection.php';
$userAddStatus = "";

if (isset($_POST["add_user"])) {
    $fullname = $_POST['fullname'];
   
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = md5($_POST['password']); 

    if (empty($errors)) {
        $insert_new_user = "INSERT INTO user (fullname,  phone,email, password) 
                            VALUES ('$fullname',  '$phone','$email', '$password')";

        if (mysqli_query($connect, $insert_new_user)) {
            $userAddStatus = "User ($fullname) Registered successfully";
        } else {
            $userAddStatus = "Error occurred while adding user";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Amaryzooh company</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

    <div class="wrapper">
        <div class="text-center mt-6 name">
            AMARYZOOH COMPANY
        </div>
        <div class="logo">
            <img src="../backend/assets//img/logo.1.png" alt="">
        </div>
        <div class="alert <?php echo !empty($userAddStatus) && strpos($userAddStatus, 'successfully') !== false ? 'alert-success' : ''; ?>" id="successMessage">
            <?php echo $userAddStatus; ?>
        </div>

        <form class="p-3 mt-3"  method="POST" onsubmit="return validateForm()">
            <div class="form-field d-flex align-items-center">

                <input type="text" name="fullname" id="fullname" placeholder="Enter Full-name" required>
            </div>
           
            <div class="form-field d-flex align-items-center">

                <input type="tel" name="phone" id="phone" placeholder="Enter Phone" pattern="[0-9]{10}" required>
                <small>Enter a 10-digit phone number.</small>
            </div>
            <div class="form-field d-flex align-items-center">

                <input type="email" name="email" id="email" placeholder="Enter Email" required>
            </div>

            <div class="form-field d-flex align-items-center">

                <input type="password" name="password" id="pwd" placeholder="Enter Password" required>
            </div>
            <button class="btn mt-3" style="background-color:#094469"   type="submit" name="add_user">Register</button>
        </form>
        <div class="text-center fs-6" style="margin-top:30px; margin-left:70px">
            Do you have an account?<a href="./login.php">Sign In</a>
        </div>
    </div>

    <script>
        function validateForm() {
            var fullname = document.getElementById('fullname').value.trim();
            var address = document.getElementById('address').value.trim();
            var phone = document.getElementById('phone').value.trim();
            var email = document.getElementById('email').value.trim();
            var password = document.getElementById('pwd').value;

            if (fullname === '') {
                alert('Please enter your full name');
                return false;
            }

            if (address === '') {
                alert('Please enter your address');
                return false;
            }

            if (phone === '') {
                alert('Please enter your phone number');
                return false;
            }

            if (!/^\d{10}$/.test(phone)) {
                alert('Please enter a valid 10-digit phone number');
                return false;
            }

            if (email === '') {
                alert('Please enter your email');
                return false;
            }

            if (!/^\S+@\S+\.\S+$/.test(email)) {
                alert('Please enter a valid email address');
                return false;
            }

            if (password === '') {
                alert('Please enter a password');
                return false;
            }

            if (password.length < 6) {
                alert('Password must be at least 6 characters long');
                return false;
            }

            return true; // Submit the form if all validations pass
        }
    </script>
</body>

</html>