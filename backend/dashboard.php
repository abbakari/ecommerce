<?php
session_start();
include '../connections/connection.php';

// Get the type and ID from the query string
if (isset($_GET['type']) && isset($_GET['id'])) {
    $type = $_GET['type'];
    $id = intval($_GET['id']); // Sanitize the ID

    // Prepare SQL query based on the type
    $table = '';
    $idField = '';

    if ($type === 'user') {
        $table = 'user';
        $idField = 'user_id';
    } elseif ($type === 'order') {
        $table = 'orders';
        $idField = 'order_id';
    } elseif ($type === 'message') {
        $table = 'message';
        $idField = 'message_id';
    } else {
        die("Invalid record type.");
    }

    // Execute the deletion query
    $sql = "DELETE FROM $table WHERE $idField = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        header("Location: ../backend/view_{$type}s.php?msg=Record deleted successfully");
    } else {
        echo "Error deleting record: " . $connect->error;
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Admin Dashboard</title>
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <link rel="stylesheet" href="./themes/vendor/owl-carousel/css/owl.carousel.min.css">
    <link rel="stylesheet" href="./themes/vendor/owl-carousel/css/owl.theme.default.min.css">
    <link href="./themes/vendor/jqvmap/css/jqvmap.min.css" rel="stylesheet">
    <link href="./themes/css/style.css" rel="stylesheet">
    <style>
        /* Style adjustments */
        .card {
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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

        .table-responsive {
            margin: 20px;
        }

        .table th, .table td {
            text-align: center;
        }

        .brand-logo {
            font-size: 24px;
            font-weight: bold;
            color: #003366;
        }
    </style>
</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>

    <div id="main-wrapper">
        <!-- Navigation Header -->
        <div class="nav-header">
            <a class="brand-logo">ADMIN DASHBOARD</a>
        </div>

        <!-- Top Header -->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <ul class="navbar-nav header-right">
                        <li class="nav-item dropdown header-profile">
                            <b style="color:#001F3F"><?php echo isset($_SESSION['fullname']) ? htmlspecialchars($_SESSION['fullname'], ENT_QUOTES, 'UTF-8') : ''; ?></b>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="../backend/logout.php" class="dropdown-item">
                                    <i class="icon-key"></i> Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="quixnav">
            <ul class="metismenu" id="menu">
                <li class="nav-label first">Main Menu</li>
                <li>
                    <a class="has-arrow" href="javascript:void(0)">
                        <i class="icon icon-app-store"></i><span class="nav-text">Users</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="../backend/view_users.php">View All</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="javascript:void(0)">
                        <i class="icon icon-app-store"></i><span class="nav-text">Orders</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="../backend/view_orders.php">View All</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="javascript:void(0)">
                        <i class="icon icon-app-store"></i><span class="nav-text">Messages</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="../backend/view_messages.php">View All</a></li>
                    </ul>
                </li>
            </ul>
        </div>

        <!-- Content Body -->
        <div class="content-body">
            <div class="container-fluid">
                <!-- Summary Cards -->
                <div class="row">
                    <!-- Total Users -->
                    <div class="col-lg-4 col-sm-12">
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
                            </div>
                        </div>
                    </div>
                    <!-- Total Orders -->
                    <div class="col-lg-4 col-sm-12">
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
                            </div>
                        </div>
                    </div>
                    <!-- Total Messages -->
                    <div class="col-lg-4 col-sm-12">
                        <div class="card">
                            <div class="stat-widget-two card-body">
                                <?php
                                $sql = "SELECT COUNT(*) AS total_messages FROM message";
                                $result = $connect->query($sql);
                                $total_messages = $result->num_rows > 0 ? $result->fetch_assoc()["total_messages"] : 0;
                                ?>
                                <div class="stat-content">
                                    <div class="stat-text">Total Messages</div>
                                    <div class="stat-digit"><?php echo $total_messages; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Messages Table -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Messages</h4>
                                <div class="table-responsive">
                                    <?php
                                    $sql = "SELECT * FROM message";
                                    $result = $connect->query($sql);
                                    if ($result->num_rows > 0) :
                                    ?>
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Full Name</th>
                                                    <th>Location</th>
                                                    <th>Email</th>
                                                    <th>Message</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($row = $result->fetch_assoc()) : ?>
                                                    <tr>
                                                        <td><?php echo htmlspecialchars($row['fullname'], ENT_QUOTES, 'UTF-8'); ?></td>
                                                        <td><?php echo htmlspecialchars($row['location'], ENT_QUOTES, 'UTF-8'); ?></td>
                                                        <td><?php echo htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8'); ?></td>
                                                        <td><?php echo htmlspecialchars($row['messange'], ENT_QUOTES, 'UTF-8'); ?></td>
                                                        <td>
                                                            <a href="edit_message.php?id=<?php echo $row['message_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                                            <a href="delete_message.php?id=<?php echo $row['message_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this message?');">Delete</a>
                                                        </td>
                                                    </tr>
                                                <?php endwhile; ?>
                                            </tbody>
                                        </table>
                                    <?php else : ?>
                                        <p>No messages found.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="./themes/js/common.min.js"></script>
    <script src="./themes/js/custom.min.js"></script>
    <script src="./themes/js/settings.js"></script>
</body>

</html>
