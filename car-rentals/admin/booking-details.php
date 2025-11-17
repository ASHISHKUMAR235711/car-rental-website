<?php
session_start();
include('../includes/db.php');

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    echo "No booking ID provided.";
    exit();
}

$booking_id = $_GET['id'];

$query = "SELECT bookings.*, users.name AS fullname, users.email, users.phone, cars.brand, cars.model, cars.number_plate 
          FROM bookings 
          JOIN users ON bookings.user_id = users.id 
          JOIN cars ON bookings.vehicle_id = cars.id 
          WHERE bookings.id = '$booking_id'";

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    echo "Booking not found.";
    exit();
}

$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Booking Details</title>
    <style>
        .container { width: 60%; margin: 40px auto; border: 1px solid #ccc; padding: 20px; border-radius: 8px; font-family: Arial; }
        h2 { text-align: center; }
        .info { margin-bottom: 10px; }
        .label { font-weight: bold; display: inline-block; width: 150px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Booking Details</h2>

        <div class="info"><span class="label">User:</span> <?= htmlspecialchars($row['fullname']) ?></div>
        <div class="info"><span class="label">Email:</span> <?= htmlspecialchars($row['email']) ?></div>
        <div class="info"><span class="label">Phone:</span> <?= htmlspecialchars($row['phone']) ?></div>

        <div class="info"><span class="label">Car:</span> <?= $row['brand'] . " " . $row['model'] ?> (<?= $row['number_plate'] ?>)</div>
        <div class="info"><span class="label">From Date:</span> <?= $row['from_date'] ?></div>
        <div class="info"><span class="label">To Date:</span> <?= $row['to_date'] ?></div>
        <div class="info"><span class="label">Status:</span> <?= ucfirst($row['status']) ?></div>

        <br>
        <a href="manage-bookings.php" style="text-decoration:none; color:white; background-color:#444; padding:8px 12px; border-radius:5px;">← Back to Bookings</a>
    </div>
</body>
</html>
