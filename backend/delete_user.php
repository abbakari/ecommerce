<?php
include("../connections/connection.php");
$user_id = $_REQUEST['user_id'];
$query = "DELETE FROM user WHERE user_id=$user_id";
$result = mysqli_query($connect, $query) or die(mysqli_error($connect));

// Check if deletion was successful
if ($result) {
    // Redirect to view.php with success message
    header("Location: ./view_user.php?success=1");
} else {
    // Redirect to view.php with failure message
    header("Location: ./view_user.php?success=0");
}
exit();