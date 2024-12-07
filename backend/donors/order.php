<?php
session_start();
include '../../connections/connection.php'; // Adjust the path if necessary

// Fetch orders from the database
$sql = "SELECT * FROM orders ORDER BY created_at DESC"; // Assuming you have a created_at field
$result = $connect->query($sql);

?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Amaryzooh Company - Orders</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <style>
    /* Custom Styling */
    body {
      background-color: #f8f9fa;
    }
    .container {
      margin-top: 20px;
    }
    .table th, .table td {
      vertical-align: middle;
    }
    .alert {
      margin-bottom: 20px;
    }
    .header {
      background-color: #343a40;
      color: #fff;
      padding: 15px;
    }
    .header h1 {
      margin: 0;
    }
  </style>
</head>
<body>
  <div class="header">
    <div class="container">
      <h1>Customer - Orders</h1>
    </div>
  </div>

  <div class="container mt-5">
    <?php
    if (isset($_SESSION['order_success'])) {
        echo '<div class="alert alert-success">' . $_SESSION['order_success'] . '</div>';
        unset($_SESSION['order_success']);
    }
    if (isset($_SESSION['order_error'])) {
        echo '<div class="alert alert-danger">' . $_SESSION['order_error'] . '</div>';
        unset($_SESSION['order_error']);
    }
    ?>

    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Order List</h4>
      </div>
      <div class="card-body">
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
              <th>Comments</th>
              <th>Date</th>
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
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='10'>No orders found.</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>
















  <!-- Orders Table -->
  <div class="col-lg-6 col-sm-12">
                        <div class="card">
                            <div class="card-body">
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
                                                <th>Customer Name</th>
                                                <th>Product Name</th>
                                                <th>Customer Address</th>
                                                <th>Product Price</th>
                                                <th> Payment Status</th>
                                                <th> Comments</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>
                                                        <td>{$row['order_id']}</td>
                                                        <td>{$row['customer_name']}</td>
                                                        <td>{$row['product_name']}</td>
                                                        <td>{$row['customer_address']}</td>
                                                        <td>{$row['product_price']}</td>
                                                          <td>{$row['payment_method']}</td>
                                                        <td>{$row['comments']}</td>
                                                        <td>
                                                            <a href='view_order.php?id={$row['order_id']}' class='btn btn-info btn-sm'>View</a>
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