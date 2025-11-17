<?php
session_start();
include('../includes/db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $booking_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    // Ensure user owns this booking
    $check = mysqli_query($conn, "SELECT * FROM bookings WHERE id = $booking_id AND user_id = $user_id");
    if (mysqli_num_rows($check) == 1) {
        mysqli_query($conn, "UPDATE bookings SET status = 'cancelled' WHERE id = $booking_id");
        header("Location: my-bookings.php?msg=Booking cancelled successfully.");
        exit();
    } else {
        header("Location: my-bookings.php?error=Unauthorized access.");
        exit();
    }
} else {
    header("Location: my-bookings.php?error=Invalid request.");
    exit();
}
