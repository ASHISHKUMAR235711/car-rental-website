<?php
session_start();
include('../includes/db.php');

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Count totals
$car_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM cars"))['total'];
$user_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM users"))['total'];
$booking_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM bookings"))['total'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500&display=swap" rel="stylesheet">
    <style>
    :root {
        --bg-gradient: linear-gradient(135deg, #000000, #1a1a2e);
        --text-color: #fff;
        --card-bg: rgba(0, 255, 255, 0.08);
        --card-border: rgba(0,255,255,0.3);
        --card-shadow: rgba(0, 255, 255, 0.2);
        --accent: cyan;
        --btn-bg: cyan;
        --btn-color: black;
    }

    body.light {
        --bg-gradient: linear-gradient(135deg, #ffffff, #e0f7fa);
        --text-color: #000;
        --card-bg: rgba(0, 0, 0, 0.05);
        --card-border: rgba(0,0,0,0.1);
        --card-shadow: rgba(0, 0, 0, 0.1);
        --accent: #0077ff;
        --btn-bg: #0077ff;
        --btn-color: #fff;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Orbitron', sans-serif;
        background: var(--bg-gradient);
        color: var(--text-color);
        min-height: 100vh;
        overflow-x: hidden;
        transition: 0.3s ease;
    }

    h1 {
        text-align: center;
        font-size: 40px;
        margin: 40px 0 10px;
        text-shadow: 0 0 15px var(--accent);
    }

    #themeToggle {
        padding: 10px 20px;
        background: var(--btn-bg);
        color: var(--btn-color);
        border: none;
        border-radius: 10px;
        cursor: pointer;
        font-weight: bold;
        box-shadow: 0 0 10px var(--accent);
        margin-top: 10px;
    }

    .dashboard-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
        padding: 40px;
        width: 90%;
        margin: auto;
    }

    .card {
        background: var(--card-bg);
        padding: 30px;
        border-radius: 20px;
        border: 1px solid var(--card-border);
        backdrop-filter: blur(10px);
        box-shadow: 0 0 20px var(--card-shadow);
        text-align: center;
        transition: all 0.3s ease-in-out;
    }

    .card:hover {
        transform: scale(1.05);
        box-shadow: 0 0 30px var(--accent);
    }

    .card h2 {
        font-size: 26px;
        margin-bottom: 15px;
        color: var(--accent);
        text-shadow: 0 0 5px var(--accent);
    }

    .card p {
        font-size: 18px;
        color: #ccc;
    }

    a.btn {
        display: inline-block;
        margin-top: 20px;
        padding: 10px 20px;
        background: var(--btn-bg);
        color: var(--btn-color);
        font-weight: bold;
        border-radius: 12px;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 0 15px var(--accent);
    }

    a.btn:hover {
        background: white;
        color: black;
        box-shadow: 0 0 25px var(--accent);
    }

    </style>
</head>
<body>

<h1>Welcome, Admin 🚀</h1>
<div style="text-align: center;">
    <button id="themeToggle">🌗 Toggle Theme</button>
</div>

<div style="
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    margin: 30px auto;
    max-width: 1000px;
">
    <div style="
        background: #f1c40f;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        text-align: center;
        width: 220px;
        margin: 15px;
        color: #fff;
        font-size: 18px;
        font-weight: bold;
    ">
        🚘 Total Bookings
        <div style="font-size: 28px; margin-top: 10px;">
            <?php
                $bookings = mysqli_query($conn, "SELECT COUNT(*) AS total FROM bookings");
                $b = mysqli_fetch_assoc($bookings);
                echo $b['total'];
            ?>
        </div>
    </div>

    <div style="
        background: #2ecc71;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        text-align: center;
        width: 220px;
        margin: 15px;
        color: #fff;
        font-size: 18px;
        font-weight: bold;
    ">
        ✅ Confirmed Bookings
        <div style="font-size: 28px; margin-top: 10px;">
            <?php
                $confirmed = mysqli_query($conn, "SELECT COUNT(*) AS total FROM bookings WHERE status='confirmed'");
                $c = mysqli_fetch_assoc($confirmed);
                echo $c['total'];
            ?>
        </div>
    </div>

    <div style="
        background: #e74c3c;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        text-align: center;
        width: 220px;
        margin: 15px;
        color: #fff;
        font-size: 18px;
        font-weight: bold;
    ">
        ❌ Cancelled Bookings
        <div style="font-size: 28px; margin-top: 10px;">
            <?php
                $cancelled = mysqli_query($conn, "SELECT COUNT(*) AS total FROM bookings WHERE status='cancelled'");
                $cc = mysqli_fetch_assoc($cancelled);
                echo $cc['total'];
            ?>
        </div>
    </div>
</div>

<div class="dashboard-container">
    <div class="card">
        <h2>Total Cars</h2>
        <a href="manage-vehicles.php" class="btn">Manage Cars</a>
    </div>

    <div class="card">
        <h2>Total Users</h2>
        <a href="manageuser.php" class="btn">Manage Users</a>
    </div>

    <div class="card">
        <h2>Total Bookings</h2>
        <a href="manage-bookings.php" class="btn">View Bookings</a>
    </div>

    <div class="card">
        <h2>Admin Tools</h2>
        <p>Control Panel</p>
        <a href="settings.php" class="btn">Settings</a>
    </div>
</div>

<script>
    const toggleBtn = document.getElementById("themeToggle");
    const body = document.body;

    const savedTheme = localStorage.getItem("theme");
    if (savedTheme === "light") {
        body.classList.add("light");
    }

    toggleBtn.addEventListener("click", () => {
        body.classList.toggle("light");
        const theme = body.classList.contains("light") ? "light" : "dark";
        localStorage.setItem("theme", theme);
    });
</script>

</body>
</html>
