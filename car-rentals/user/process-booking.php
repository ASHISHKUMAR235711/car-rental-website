<?php
session_start();
include('../includes/db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vehicle_id = $_POST['car_id'];
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];

    $status = 'Pending';
    $payment_status = 'Unpaid';

    // Sample static price (e.g. ₹500.00 = 50000 paisa)
    // You can fetch dynamic price based on car later
    $amount = 50000;

    $sql = "INSERT INTO bookings (user_id, vehicle_id, from_date, to_date, status, payment_status)
            VALUES ('$user_id', '$vehicle_id', '$from_date', '$to_date', '$status', '$payment_status')";

    if (mysqli_query($conn, $sql)) {
        $booking_id = mysqli_insert_id($conn);

        // Store payment details in session
        $_SESSION['booking_id'] = $booking_id;
        $_SESSION['amount'] = $amount;

        // Redirect to Razorpay payment page
        header("Location: payment.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
