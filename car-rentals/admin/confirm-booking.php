<?php
include('../db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "UPDATE bookings SET status='Confirmed' WHERE id='$id'";
    if (mysqli_query($conn, $query)) {
        header("Location: manage-bookings.php?msg=confirmed");
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
} else {
    echo "No booking ID provided.";
}
?>
