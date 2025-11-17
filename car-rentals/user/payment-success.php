<?php
session_start();
include('../includes/db.php');

if (!isset($_GET['booking_id']) || !isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$booking_id = intval($_GET['booking_id']);
$user_id = $_SESSION['user_id'];

// Verify booking belongs to this user
$check = mysqli_query($conn, "SELECT * FROM bookings WHERE id = $booking_id AND user_id = $user_id");
if (mysqli_num_rows($check) == 1) {
    mysqli_query($conn, "UPDATE bookings SET payment_status = 'paid' WHERE id = $booking_id");

    // Clear session
    unset($_SESSION['amount']);
    unset($_SESSION['booking_id']);

    header("Location: my-bookings.php?msg=Payment+Successful!");
    exit();
} else {
    echo "<h3 style='color:red; text-align:center;'>Invalid Booking</h3>";
}
?>
