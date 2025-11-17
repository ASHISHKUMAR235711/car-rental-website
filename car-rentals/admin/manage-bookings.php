<?php
session_start();
include('../includes/db.php');

// Redirect if admin not logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Handle booking status update
if (isset($_GET['id']) && isset($_GET['status'])) {
    $booking_id = intval($_GET['id']);
    $new_status = $_GET['status'];

    if (in_array($new_status, ['confirmed', 'cancelled'])) {
        $stmt = $conn->prepare("UPDATE bookings SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $new_status, $booking_id);
        if ($stmt->execute()) {
            header("Location: manage-bookings.php?msg=Booking $new_status successfully!");
        } else {
            header("Location: manage-bookings.php?msg=Error updating status.");
        }
        $stmt->close();
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Bookings</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-color: linear-gradient(135deg, #1e3c72, #2a5298);
            --text-color: #fff;
            --card-bg: rgba(255, 255, 255, 0.05);
            --table-header: rgba(0,0,0,0.6);
            --border-color: rgba(255, 255, 255, 0.1);
        }

        body.light {
            --bg-color: linear-gradient(135deg, #ffffff, #cfd9df);
            --text-color: #000;
            --card-bg: rgba(255, 255, 255, 0.85);
            --table-header: #f1f1f1;
            --border-color: rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg-color);
            margin: 0;
            padding: 0;
            color: var(--text-color);
            transition: 0.3s ease;
        }

        h2 {
            text-align: center;
            margin-top: 30px;
            font-size: 32px;
            color: #f0db4f;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }

        table {
            width: 90%;
            margin: 30px auto;
            border-collapse: collapse;
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            overflow: hidden;
            background-color: var(--card-bg);
            backdrop-filter: blur(5px);
            animation: fadeInUp 1s ease;
        }

        th, td {
            padding: 12px;
            border: 1px solid var(--border-color);
            text-align: center;
        }

        th {
            background-color: var(--table-header);
            color: #f0f0f0;
        }

        td {
            color: inherit;
        }

        a.btn {
            padding: 8px 14px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0,0,0,0.3);
        }

        .approve {
            background: linear-gradient(to right, #00b09b, #96c93d);
            color: white;
        }

        .cancel {
            background: linear-gradient(to right, #ff416c, #ff4b2b);
            color: white;
        }

        .approve:hover, .cancel:hover {
            transform: scale(1.05);
        }

        td a {
            display: inline-block;
            margin: 5px;
        }

        td[style*='green'], td[style*='red'], td[style*='orange'] {
            font-weight: bold;
        }

        @keyframes fadeInUp {
            0% { transform: translateY(30px); opacity: 0; }
            100% { transform: translateY(0); opacity: 1; }
        }

        /* Theme Toggle Icon Button */
        #themeToggle {
            background: none;
            border: none;
            font-size: 22px;
            color: white;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        #themeToggle:hover {
            transform: rotate(15deg);
        }

        body.light #themeToggle {
            color: #000;
        }
    </style>
</head>
<body>

<!-- Top Navigation Bar -->
<div style="
    background: linear-gradient(90deg, #2c3e50, #3498db);
    padding: 15px 30px;
    color: white;
    font-size: 20px;
    font-weight: bold;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
">
    <span>🚗 Car Rental Admin Panel</span>
    <div>
        <button id="themeToggle" title="Toggle Theme">🌙</button>
        <a href="dashboard.php" style="
            color: white;
            background: rgba(255, 255, 255, 0.2);
            padding: 8px 15px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            margin-left: 15px;
        " onmouseover="this.style.background='rgba(255,255,255,0.3)'" onmouseout="this.style.background='rgba(255,255,255,0.2)'">🏠 Dashboard</a>
    </div>
</div>

<!-- Theme Toggle Script -->
<script>
    const toggleBtn = document.getElementById("themeToggle");
    const body = document.body;

    function setThemeIcon() {
        toggleBtn.textContent = body.classList.contains("light") ? "☀️" : "🌙";
    }

    const savedTheme = localStorage.getItem("theme");
    if (savedTheme === "light") {
        body.classList.add("light");
    }
    setThemeIcon();

    toggleBtn.addEventListener("click", () => {
        body.classList.toggle("light");
        localStorage.setItem("theme", body.classList.contains("light") ? "light" : "dark");
        setThemeIcon();
    });
</script>

<!-- Booking Summary Cards -->
<div style="display: flex; justify-content: center; gap: 20px; margin: 30px 0; flex-wrap: wrap;">
    <?php
    $statuses = [
        'pending' => ['Pending Bookings', '#16a085'],
        'confirmed' => ['Confirmed Bookings', '#2980b9'],
        'cancelled' => ['Cancelled Bookings', '#c0392b'],
    ];
    foreach ($statuses as $status => [$label, $color]) {
        $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM bookings WHERE status = ?");
        $stmt->bind_param("s", $status);
        $stmt->execute();
        $stmt->bind_result($total);
        $stmt->fetch();
        $stmt->close();
        echo "<div style='background: $color; color: white; padding: 20px; border-radius: 15px; width: 220px; text-align: center; box-shadow: 0 4px 10px rgba(0,0,0,0.3);'>
            $label
            <div style='font-size: 28px; margin-top: 10px;'>$total</div>
        </div>";
    }
    ?>
</div>

<h2>All Bookings</h2>

<?php
if (isset($_GET['msg'])) {
    echo "<p style='color: green; text-align: center; font-weight: bold;'>" . htmlspecialchars($_GET['msg']) . "</p>";
}
?>

<!-- Bookings Table -->
<table>
    <tr>
        <th>#</th>
        <th>User</th>
        <th>Car</th>
        <th>From</th>
        <th>To</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

    <?php
    $query = "SELECT bookings.*, users.name AS fullname, vehicles.brand, vehicles.model 
          FROM bookings 
          JOIN users ON bookings.user_id = users.id 
          JOIN vehicles ON bookings.vehicle_id = vehicles.id 
          ORDER BY bookings.id DESC";


    $result = mysqli_query($conn, $query);
    $i = 1;

    while ($row = mysqli_fetch_assoc($result)) {
        $status = ucfirst($row['status']);
        $color = match (strtolower($row['status'])) {
            'confirmed' => 'green',
            'cancelled' => 'red',
            'pending' => 'orange',
            default => 'white'
        };

        echo "<tr>";
        echo "<td>{$i}</td>";
        echo "<td>{$row['fullname']}</td>";
        echo "<td>{$row['brand']} {$row['model']}</td>";
        echo "<td>{$row['from_date']}</td>";
        echo "<td>{$row['to_date']}</td>";
        echo "<td style='color: $color;'>$status</td>";
        echo "<td>";
        if (strtolower($row['status']) === 'pending') {
            echo "<a class='btn approve' href='?id={$row['id']}&status=confirmed'>Approve</a> ";
            echo "<a class='btn cancel' href='?id={$row['id']}&status=cancelled'>Cancel</a> ";
        }
        echo "<a class='btn' style='background-color: #007BFF; color: white;' href='booking-details.php?id={$row['id']}'>Details</a>";
        echo "</td>";
        echo "</tr>";

        $i++;
    }
    ?>
</table>

</body>
</html>