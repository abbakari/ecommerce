<?php
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
