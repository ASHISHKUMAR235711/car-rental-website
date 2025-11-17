<?php
session_start();
include('../includes/db.php');

if (!isset($_SESSION['user_id']) || !isset($_SESSION['booking_id']) || !isset($_SESSION['amount'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$booking_id = $_SESSION['booking_id'];
$amount = $_SESSION['amount']; // in paisa (e.g. ₹500 = 50000)

// Create order ID from Razorpay (optional, you can use JS directly for test mode)

// Razorpay Key (TEST)
$razorpay_key = "rzp_test_q0HdDwDakma8MD"; // Replace with your real test key
?>
<!DOCTYPE html>
<html>
<head>
    <title>Payment | Speedy Rentals</title>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <style>
        body {
            background: #f4f6f8;
            font-family: 'Segoe UI', sans-serif;
            text-align: center;
            padding: 50px;
        }

        .btn-pay {
            background-color: #007bff;
            color: #fff;
            padding: 15px 30px;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
            margin-top: 30px;
        }

        .btn-pay:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <h2>Complete Payment</h2>
    <p>Booking ID: <strong>#<?= $booking_id ?></strong></p>
    <p>Amount: <strong>₹<?= number_format($amount / 100, 2) ?></strong></p>

    <button class="btn-pay" id="rzp-button1">Pay Now</button>

    <form id="success-form" action="payment-success.php" method="GET" style="display:none;">
        <input type="hidden" name="booking_id" value="<?= $booking_id ?>">
    </form>

    <script>
        var options = {
            "key": "<?= $razorpay_key ?>",
            "amount": "<?= $amount ?>",
            "currency": "INR",
            "name": "Speedy Rentals",
            "description": "Car Booking Payment",
            "handler": function (response){
                // On success redirect
                document.getElementById('success-form').submit();
            },
            "prefill": {
                "name": "",
                "email": "",
                "contact": ""
            },
            "theme": {
                "color": "#007bff"
            }
        };

        var rzp1 = new Razorpay(options);

        document.getElementById('rzp-button1').onclick = function(e){
            rzp1.open();
            e.preventDefault();
        }
    </script>
</body>
</html>
