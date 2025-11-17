<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}
include('../includes/db.php');

// Delete logic
if (isset($_GET['del'])) {
    $id = $_GET['del'];
    mysqli_query($conn, "DELETE FROM vehicles WHERE id='$id'");
    header("Location: manage-vehicles.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM vehicles");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Vehicles</title>
    <link href="https://fonts.googleapis.com/css2?family=Segoe+UI&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-color: linear-gradient(to right, #e0f7fa, #e1bee7);
            --text-color: #000;
            --table-bg: #fff;
            --hover-bg: #f1f1f1;
            --btn-color: white;
            --btn-bg: #6200ea;
            --border-color: #ddd;
        }

        body.light {
            --bg-color: #fdfdfd;
            --text-color: #000;
            --table-bg: #fff;
            --hover-bg: #f7f7f7;
        }

        body.dark {
            --bg-color: linear-gradient(to right, #2c3e50, #4ca1af);
            --text-color: #f1f1f1;
            --table-bg: rgba(255,255,255,0.05);
            --hover-bg: rgba(255,255,255,0.1);
            --btn-color: white;
            --btn-bg: #333;
            --border-color: rgba(255,255,255,0.1);
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: var(--bg-color);
            color: var(--text-color);
            padding: 30px;
            transition: background 0.3s, color 0.3s;
        }

        h2 {
            text-align: center;
            font-size: 32px;
            margin-bottom: 30px;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.2);
        }

        .add-vehicle-btn {
            display: block;
            width: fit-content;
            margin: 0 auto 20px auto;
            background: #28a745;
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 16px;
            font-weight: bold;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease-in-out;
            box-shadow: 0 0 10px #28a745;
        }

        .add-vehicle-btn:hover {
            background: #218838;
            box-shadow: 0 0 20px #28a745, 0 0 10px #218838 inset;
        }

        table {
            width: 95%;
            margin: auto;
            border-collapse: collapse;
            background: var(--table-bg);
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 15px;
            border-bottom: 1px solid var(--border-color);
            text-align: center;
        }

        th {
            background: var(--btn-bg);
            color: var(--btn-color);
            font-size: 18px;
        }

        tr:hover {
            background-color: var(--hover-bg);
        }

        a.btn {
            padding: 8px 15px;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            transition: background 0.3s;
        }

        .edit {
            background: #ffc107;
            margin-right: 5px;
        }

        .edit:hover {
            background: #e0a800;
        }

        .delete {
            background: #dc3545;
        }

        .delete:hover {
            background: #c82333;
        }

        /* Theme toggle */
        #themeToggle {
            position: absolute;
            top: 15px;
            right: 30px;
            background: none;
            border: none;
            font-size: 22px;
            color: inherit;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        #themeToggle:hover {
            transform: rotate(15deg);
        }
    </style>
</head>
<body>

<!-- Theme Toggle Button -->
<button id="themeToggle" title="Toggle Theme">🌙</button>

<h2>🚗 Manage Vehicles</h2>

<a class="btn add-vehicle-btn" href="add-vehicle.php">➕ Add New Vehicle</a>

<table>
    <tr>
        <th>ID</th>
        <th>Brand</th>
        <th>Model</th>
        <th>Overview</th>
        <th>Price</th>
        <th>Actions</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['brand'] ?></td>
            <td><?= $row['model'] ?></td>
            <td><?= $row['overview'] ?></td>
            <td>₹<?= $row['price'] ?>/day</td>
            <td>
                <a class="btn edit" href="edit-vehicle.php?id=<?= $row['id'] ?>">Edit</a>
                <a class="btn delete" href="manage-vehicles.php?del=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
    <?php } ?>
</table>

<!-- Theme Toggle Script -->
<script>
    const toggleBtn = document.getElementById("themeToggle");
    const body = document.body;

    function updateIcon() {
        toggleBtn.textContent = body.classList.contains("dark") ? "☀️" : "🌙";
    }

    // Load saved theme
    const savedTheme = localStorage.getItem("theme");
    if (savedTheme === "dark") {
        body.classList.add("dark");
    }
    updateIcon();

    // Toggle theme
    toggleBtn.addEventListener("click", () => {
        body.classList.toggle("dark");
        localStorage.setItem("theme", body.classList.contains("dark") ? "dark" : "light");
        updateIcon();
    });
</script>

</body>
</html>
