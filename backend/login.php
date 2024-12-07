<?php
session_start();
include '../connections/connection.php';

$message = ""; 

if (isset($_POST['login_data'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $message = "Please enter both email and password.";
    } else {
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $message = "Invalid email format.";
        } else {
            $password = md5($password);

            $sql = "SELECT * FROM user WHERE email='$email' AND password='$password'";
            $result = mysqli_query($connect, $sql);
            $number = mysqli_num_rows($result);
            if ($number > 0) {
                $row = mysqli_fetch_assoc($result);
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['fullname'] = $row['fullname'];
                $_SESSION['role'] = $row['role'];

                if ($row['role'] == "Admin") {
                    $redirectUrl = 'dashboard.php';
                } else {
                    $redirectUrl = '../fontend\project\shop.php';
                }

                header("Location: $redirectUrl");
                exit;
            } else {
                $message = "Wrong username or password. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Amaryzooh Company</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <style>
        .error-message {
            margin-top: 10px;
            color: red;
        }

        .loader {
            display: none;
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <div class="wrapper">
        <div class="text-center mt-6 name">
          AMARYZOOH COMPANY
        </div>
        <div class="logo">
            <img src="../backend/assets/img/logo.1.png" alt="">
        </div>
        <?php if (!empty($message)) : ?>
            <div class="<?php echo $loginSuccess ? 'success-message' : 'error-message'; ?>" style="text-align:center">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        <div class="loader" id="loader" style="text-align: center;">
            Welcome...
        </div>
        <form class="p-3 mt-3" method="POST" action="" onsubmit="showLoader()">
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span>
                <input type="text" name="email" id="userName" placeholder="Username">
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input type="password" name="password" id="pwd" placeholder="Password">
            </div>
            <button class="btn mt-3"  style="background-color:#094469" type="submit" name="login_data">Login</button>
        </form>
        <div class="text-center fs-6" style="margin-top:30px; margin-left:70px" style="color:chocolate;">
            Don't you have an account?<a href="./register.php">Sign up</a>
        </div>
    </div>

    <script>
        function showLoader() {
            document.getElementById("loader").style.display = "block";
        }
    </script>

</body>

</html>