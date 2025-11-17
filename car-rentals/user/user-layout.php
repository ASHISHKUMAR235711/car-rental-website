
<style>
    body {
        margin: 0;
        font-family: 'Segoe UI', sans-serif;
        background: #f5f7fa;
    }

    .top-nav {
        background: #2f3542;
        color: #fff;
        padding: 12px 20px;
        font-size: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    }

    .sidebar {
        position: fixed;
        top: 54px;
        left: 0;
        width: 220px;
        height: 100%;
        background: #3742fa;
        padding-top: 20px;
        box-shadow: 2px 0 6px rgba(0,0,0,0.1);
    }

    .sidebar a {
        display: block;
        color: #fff;
        padding: 12px 20px;
        text-decoration: none;
        transition: background 0.3s;
    }

    .sidebar a:hover {
        background: #57606f;
    }

    .main-content {
        margin-left: 240px;
        padding: 20px;
    }
</style>

<div class="top-nav">
    <span>🚗 Car Rental User Panel</span>
    <span><a href="logout.php" style="color: #fff; text-decoration: none;">Logout</a></span>
</div>

<div class="sidebar">
    <a href="dashboard.php">🏠 Dashboard</a>
    <a href="profile.php">👤 Profile</a>
    <a href="my-bookings.php">📖 My Bookings</a>
    <a href="book-car.php">🛻 Book a Car</a>
    <a href="check-availability.php">✅ Check Availability</a>
</div>

<!-- The rest of the files will follow this layout with include('user-layout.php') at the top -->
