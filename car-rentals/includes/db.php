<?php
$host = "localhost";
$user = "root";         // default username in XAMPP
$pass = "";             // no password by default
$dbname = "car_rental"; // your database name

$conn = mysqli_connect($host, $user, $pass, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// echo "Database connected successfully!"; // you can enable this to check
?>
