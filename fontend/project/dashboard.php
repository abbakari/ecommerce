<?php
session_start();
include '../../connections/connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Admin Dashboard</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <link rel="stylesheet" href="./themes/vendor/owl-carousel/css/owl.carousel.min.css">
    <link rel="stylesheet" href="./themes/vendor/owl-carousel/css/owl.theme.default.min.css">
    <link href="./themes/vendor/jqvmap/css/jqvmap.min.css" rel="stylesheet">
    <link href="./themes/css/style.css" rel="stylesheet">
    <style>
        .card {
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .stat-widget-two .stat-content {
            text-align: center;
        }
        .stat-widget-two .stat-text {
            font-size: 16px;
            color: #333;
        }
        .stat-widget-two .stat-digit {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
        }
        .progress-bar {
            height: 6px;
        }
        .navbar-nav.header-right .nav-item {
            margin-left: 15px;
        }
        .brand-logo {
            font-size: 24px;
            font-weight: bold;
            color: #003366;
        }
        .quixnav-scroll {
            background: #f8f9fa;
        }
        .metismenu a {
            color: #333;
        }
        .metismenu a:hover {
            color: #007bff;
        }
        .header-profile .dropdown-menu {
            min-width: 120px;
        }
        .dropdown-item i {
            margin-right: 8px;
        }
        .table-responsive {
            margin-top: 20px;
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

    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a class="brand-logo">ADMIN DASHBOARD</a>
            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left"></div>
                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-account"></i>
                                </a>
                                <b style="color:#001F3F"><?php echo isset($_SESSION['fullname']) ? $_SESSION['fullname'] : ''; ?></b>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="../logout.php" class="dropdown-item">
                                        <i class="icon-key"></i>
                                        <span class="ml-2">Logout</span>
                                    </a>
                                </div>
                            </li>
                        </ul>
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
                    <li class="nav-label first">Main Menu</li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="icon icon-app-store"></i><span class="nav-text">Users</span></a>
                        <ul aria-expanded="false">
                            <li><a href="../view_users.php">View All</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="icon icon-app-store"></i><span class="nav-text">Orders</span></a>
                        <ul aria-expanded="false">
                            <li><a href="../view_orders.php">View All</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        <!--**********************************
            Content body start here
        ***********************************-->
        <div class="content-body" style="margin-top: 50px;">
            <div class="container-fluid shadow">
                <div class="row">
                    <!-- Users Summary -->
                    <div class="col-lg-6 col-sm-12">
                        <div class="card">
                            <div class="stat-widget-two card-body">
                                <?php
                                $sql = "SELECT COUNT(*) AS total_users FROM user";
                                $result = $connect->query($sql);
                                $total_users = $result->num_rows > 0 ? $result->fetch_assoc()["total_users"] : 0;
                                ?>
                                <div class="stat-content">
                                    <div class="stat-text">Total Users</div>
                                    <div class="stat-digit"><?php echo $total_users; ?></div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-success w-100" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Orders Summary -->
                    <div class="col-lg-6 col-sm-12">
                        <div class="card">
                            <div class="stat-widget-two card-body">
                                <?php
                                $sql = "SELECT COUNT(*) AS total_orders FROM orders";
                                $result = $connect->query($sql);
                                $total_orders = $result->num_rows > 0 ? $result->fetch_assoc()["total_orders"] : 0;
                                ?>
                                <div class="stat-content">
                                    <div class="stat-text">Total Orders</div>
                                    <div class="stat-digit"><?php echo $total_orders; ?></div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-primary w-100" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Detailed Tables -->
                <div class="row">
                    <!-- Users Table -->
                    <div class="col-lg-6 col-sm-12">
                        <div class="card">
                            <div class="card-body">
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
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Orders Table -->
                    <div class="col-lg-6 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Order List</h4>
                                <div class="table-responsive">
                                    <?php
                                    $sql = "SELECT * FROM orders";
                                    $result = $connect->query($sql);
                                    ?>
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Product Name</th>
                                                <th>Price</th>
                                                <th>Customer Name</th>
                                                <th>Customer Email</th>
                                                <th>Address</th>
                                                <th>Payment Method</th>
                                                <th>Location</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>
                                                        <td>{$row['order_id']}</td>
                                                        <td>{$row['product_name']}</td>
                                                        <td>{$row['product_price']}</td>
                                                        <td>{$row['customer_name']}</td>
                                                        <td>{$row['customer_email']}</td>
                                                        <td>{$row['customer_address']}</td>
                                                        <td>{$row['payment_method']}</td>
                                                        <td>{$row['location']}</td>
                                                        <td>
                                                            <a href='edit_order.php?id={$row['order_id']}' class='btn btn-warning btn-sm'>Edit</a>
                                                            <a href='delete_order.php?id={$row['order_id']}' class='btn btn-danger btn-sm'>Delete</a>
                                                        </td>
                                                    </tr>";
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
        </div>
    </div>

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="./themes/plugins/common/common.min.js"></script>
    <script src="./themes/js/custom.min.js"></script>
    <script src="./themes/js/settings.js"></script>
    <script src="./themes/js/gleek.js"></script>
    <script src="./themes/js/styleSwitcher.js"></script>
    <script src="./themes/vendor/owl-carousel/js/owl.carousel.min.js"></script>
    <script src="./themes/vendor/jqvmap/js/jquery.vmap.min.js"></script>
    <script src="./themes/vendor/jqvmap/js/jquery.vmap.usa.js"></script>
    <script src="./themes/vendor/jquery.counterup/jquery.counterup.min.js"></script>
    <script src="./themes/js/dashboard/dashboard-1.js"></script>
</body>
</html>
