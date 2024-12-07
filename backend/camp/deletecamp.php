<?php
include("../connections/connection.php");
$camp_id = $_REQUEST['camp_id'];
$query = "DELETE FROM camp WHERE camp_id=$camp_id";
$result = mysqli_query($connect, $query) or die(mysqli_error($connect));

// Check if deletion was successful
if ($result) {
    // Redirect to view.php with success message
    header("Location: ./allcamps.php?success=1");
} else {
    // Redirect to view.php with failure message
    header("Location: ./allcamps.php?success=0");
}
exit();