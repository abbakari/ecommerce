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
    <title>View Orders</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <link href="./themes/css/style.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
        }
        .nav-header {
            background: #003366;
            color: #fff;
        }
        .brand-logo {
            font-size: 24px;
            font-weight: bold;
        }
        .content-body {
            padding: 30px;
        }
        .container-fluid {
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .card {
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .card-body {
            padding: 20px;
        }
        .table thead th {
            background-color: #003366;
            color: #fff;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }
        .btn-info, .btn-danger, .btn-warning {
            margin: 0 5px;
        }
        .btn-back {
            background-color: #28a745;
            border-color: #28a745;
            color: #fff;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
            margin-bottom: 20px;
            display: inline-block;
        }
        .btn-back:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
    </style>
</head>

<body>
    <div id="main-wrapper">
        <div class="nav-header">
            <a class="brand-logo">ADMIN DASHBOARD</a>
        </div>

        <div class="content-body">
            <div class="container-fluid shadow">
                <div class="card">
                    <div class="card-body">
                        <!-- Back to Dashboard Button -->
                        <a href="../backend/dashboard.php" class="btn btn-back">Back to Dashboard</a>
                        <h4 class="card-title">Orders</h4>
                        <div class="table-responsive">
                            <?php
                            $sql = "SELECT * FROM orders";
                            $result = $connect->query($sql);
                            ?>
                            <table class="table table-striped">
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
                                        <th>Comments</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>
                                                    <td>{$row['order_id']}</td>
                                                    <td>{$row['product_name']}</td>
                                                    <td>\${$row['product_price']}</td>
                                                    <td>{$row['customer_name']}</td>
                                                    <td>{$row['customer_email']}</td>
                                                    <td>{$row['customer_address']}</td>
                                                    <td>{$row['payment_method']}</td>
                                                    <td>{$row['location']}</td>
                                                    <td>{$row['comments']}</td>
                                                    <td>{$row['created_at']}</td>
                                                    <td>
                                                        <a href='view_orders.php?delete_id={$row['order_id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this order?\");'>Delete</a>
                                                        <a href='view_orders.php?cancel_id={$row['order_id']}' class='btn btn-warning btn-sm' onclick='return confirm(\"Are you sure you want to cancel this order?\");'>Cancel</a>
                                                    </td>
                                                </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='11'>No orders found.</td></tr>";
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