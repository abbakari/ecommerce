<?php
session_start();
include '../connections/connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Amaryzooh Company</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <link href="./themes/css/style.css" rel="stylesheet">
    <style>
        /* Add your custom styles here */
        .table-responsive {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div id="main-wrapper">
        <div class="nav-header">
            <a class="brand-logo">ADMIN DASHBOARD</a>
        </div>

        <div class="content-body" style="margin-top: 50px;">
            <div class="container-fluid shadow">
                <div class="card">
                <div class="card-body">
                        <!-- Back to Dashboard Button -->
                        <a href="../backend/dashboard.php" class="btn btn-back">Back to Dashboard</a>
                        <h4 class="card-title">Users</h4>
                        <div class="table-responsive">
                 
                            <?php
                            $sql = "SELECT * FROM user";
                            $result = $connect->query($sql);
                            ?>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Full Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>
                                                    <td>{$row['fullname']}</td>
                                                    <td>{$row['phone']}</td>
                                                    <td>{$row['email']}</td>
                                                    <td>
                                                        <a href='edit_user.php?id={$row['user_id']}' class='btn btn-warning btn-sm'>Edit</a>
                                                        <a href='delete_user.php?id={$row['user_id']}' class='btn btn-danger btn-sm'>Delete</a>
                                                    </td>
                                                </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='4'>No users found.</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
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
</body>

</html>