<?php
include('../db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "UPDATE bookings SET status='Cancelled' WHERE id='$id'";
    if (mysqli_query($conn, $query)) {
        header("Location: manage-bookings.php?msg=cancelled");
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
} else {
    echo "No booking ID provided.";
}
?>
