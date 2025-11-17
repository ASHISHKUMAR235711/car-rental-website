<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $booking_id = $_POST['booking_id'];
    // We simulate success only
    $success = true;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment Status</title>
    <style>
        body {
            background: #0d0d0d;
            color: white;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .message-box {
            background: #1a1a1a;
            padding: 40px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 0 15px #00ff99;
        }
        .success {
            color: #00ff99;
            font-size: 24px;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            color: #00f0ff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="message-box">
        <?php if ($success): ?>
            <p class="success">✅ Payment Successful for Booking #<?php echo $booking_id; ?>!</p>
            <a href="my-bookings.php">🔙 Go Back to My Bookings</a>
        <?php else: ?>
            <p class="error">❌ Payment Failed!</p>
        <?php endif; ?>
    </div>
</body>
</html>
