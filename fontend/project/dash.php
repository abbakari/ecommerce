<?php
session_start();
include '../../connections/connection.php'; // Ensure this path is correct

// Validate query string parameters
if (isset($_GET['type']) && isset($_GET['id'])) {
    $type = $_GET['type'];
    $id = intval($_GET['id']); // Sanitize the ID to avoid SQL injection

    // Determine table and field names based on type
    $table = '';
    $idField = '';

    switch ($type) {
        case 'user':
            $table = 'user';
            $idField = 'user_id';
            break;
        case 'order':
            $table = 'orders';
            $idField = 'order_id';
            break;
        case 'message':
            $table = 'message';
            $idField = 'message_id';
            break;
        default:
            die("Invalid record type.");
    }

    // Prepare the SQL query
    $sql = "DELETE FROM $table WHERE $idField = ?";
    $stmt = $connect->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('i', $id);
        if ($stmt->execute()) {
            // Redirect back to the appropriate view page with a success message
            header("Location: ../backend/view_{$type}s.php?msg=Record deleted successfully");
            exit();
        } else {
            echo "Error deleting record: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $connect->error;
    }
} else {
    echo "Invalid request.";
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        /* General styles */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .dashboard {
            display: flex;
            height: 100vh;
        }
        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: white;
            display: flex;
            flex-direction: column;
            padding: 10px;
        }
        .sidebar h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            display: block;
        }
        .sidebar a:hover {
            background-color: #34495e;
        }
        .content {
            flex: 1;
            position: relative;
            overflow: hidden;
        }
        .section {
            position: absolute;
            top: 0;
            left: 100%;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: all 0.5s ease-in-out;
        }
        .section.active {
            left: 0;
            opacity: 1;
        }
        .header {
            background-color: #2980b9;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 24px;
        }
        .card-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .card h3 {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <div class="sidebar">
            <h2>Admin Dashboard</h2>
            <a href="#" onclick="showSection('user-summary')">User Summary</a>
            <a href="#" onclick="showSection('order-summary')">Order Summary</a>
            <a href="#" onclick="showSection('message-summary')">Message Summary</a>
        </div>
        <div class="content">
            <!-- User Summary Section -->
            <div id="user-summary" class="section active">
                <div class="header">User Summary</div>
                <div class="card-container">
                    <div class="card">
                        <h3>Total Users</h3>
                        <p>
                            <?php
                            $user_query = "SELECT COUNT(*) AS total_users FROM user";
                            $user_result = mysqli_query($connect, $user_query);
                            $user_row = mysqli_fetch_assoc($user_result);
                            echo $user_row['total_users'] ?? '0';
                            ?>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Order Summary Section -->
            <div id="order-summary" class="section">
                <div class="header">Order Summary</div>
                <div class="card-container">
                    <div class="card">
                        <h3>Total Orders</h3>
                        <p>
                            <?php
                            $order_query = "SELECT COUNT(*) AS total_orders FROM orders";
                            $order_result = mysqli_query($connect, $order_query);
                            $order_row = mysqli_fetch_assoc($order_result);
                            echo $order_row['total_orders'] ?? '0';
                            ?>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Message Summary Section -->
            <div id="message-summary" class="section">
                <div class="header">Message Summary</div>
                <div class="card-container">
                    <div class="card">
                        <h3>Total Messages</h3>
                        <p>
                            <?php
                            $message_query = "SELECT COUNT(*) AS total_messages FROM message";
                            $message_result = mysqli_query($connect, $message_query);
                            $message_row = mysqli_fetch_assoc($message_result);
                            echo $message_row['total_messages'] ?? '0';
                            ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showSection(sectionId) {
            const sections = document.querySelectorAll('.section');
            sections.forEach(section => {
                section.classList.toggle('active', section.id === sectionId);
            });
        }
    </script>
</body>
</html>
