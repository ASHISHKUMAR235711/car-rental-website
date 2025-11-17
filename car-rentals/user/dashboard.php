<?php
session_start();
include('../includes/db.php'); // Added to fetch user info

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Fetch user name
$user_id = $_SESSION['user_id'];
$query = "SELECT name FROM users WHERE id = $user_id";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);
$name = $user ? $user['name'] : 'User';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #1d2b64, #f8cdda);
            color: #333;
        }

        .navbar {
            background: rgba(0, 0, 0, 0.85);
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }

        .navbar h2 {
            margin: 0;
            font-size: 24px;
        }

        .navbar a {
            color: #fff;
            margin-left: 25px;
            text-decoration: none;
            font-size: 16px;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .navbar a:hover {
            color: #ffcc00;
        }

        .welcome-msg {
            text-align: center;
            font-size: 22px;
            font-weight: 600;
            color: #fff;
            margin-top: 40px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
            animation: fadeIn 1s ease-in-out;
        }

        .dashboard {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 30px;
            padding: 60px 20px;
        }

        .card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 18px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.2);
            padding: 30px;
            width: 280px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .card::before {
            content: "";
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, #4facfe, #00f2fe);
            opacity: 0.1;
            transform: rotate(45deg);
            pointer-events: none;
        }

        .card:hover {
            transform: translateY(-12px);
            box-shadow: 0 12px 25px rgba(0,0,0,0.3);
        }

        .card h3 {
            font-size: 22px;
            margin-bottom: 10px;
        }

        .card p {
            font-size: 16px;
            color: #555;
        }

        .btn {
            margin-top: 20px;
            padding: 10px 22px;
            background: linear-gradient(to right, #4facfe, #00f2fe);
            color: white;
            border: none;
            border-radius: 25px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .btn:hover {
            background: linear-gradient(to right, #00f2fe, #4facfe);
            transform: scale(1.05);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            .dashboard {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>

<!-- Navbar -->
<div class="navbar">
    <h2><i class="fas fa-user-circle"></i> User Dashboard</h2>
    <div>
        <a href="profile.php"><i class="fas fa-user"></i> Profile</a>
        <a href="my-bookings.php"><i class="fas fa-calendar-check"></i> Bookings</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</div>

<!-- Welcome Message -->
<div class="welcome-msg">
    👋 Welcome back, <strong><?php echo htmlspecialchars($name); ?></strong>!
</div>

<!-- Cards -->
<div class="dashboard">
    <div class="card">
        <h3><i class="fas fa-car"></i> Book a Car</h3>
        <p>Explore & rent cars easily.</p>
        <a href="book-car.php" class="btn">Book Now</a>
    </div>
    <div class="card">
        <h3><i class="fas fa-clock"></i> My Bookings</h3>
        <p>Check your past & current bookings.</p>
        <a href="my-bookings.php" class="btn">View Bookings</a>
    </div>
    <div class="card">
        <h3><i class="fas fa-user-edit"></i> My Profile</h3>
        <p>Update your personal info.</p>
        <a href="profile.php" class="btn">Edit Profile</a>
    </div>
</div>

</body>
</html>
