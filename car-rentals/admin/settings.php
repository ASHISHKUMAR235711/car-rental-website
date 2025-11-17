<?php
session_start();
include('../includes/db.php');

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Settings</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-gradient: radial-gradient(circle, #2c3e50, #000000);
            --text-color: white;
            --form-bg: #1e272e;
            --input-bg: #2f3640;
            --label-color: #ddd;
            --button-bg: cyan;
            --button-hover-bg: white;
            --button-hover-color: black;
            --link-color: cyan;
        }

        body.light {
            --bg-gradient: radial-gradient(circle, #ffffff, #d3d3d3);
            --text-color: #000;
            --form-bg: #ffffff;
            --input-bg: #f0f0f0;
            --label-color: #333;
            --button-bg: #00bcd4;
            --button-hover-bg: #fff;
            --button-hover-color: #000;
            --link-color: #007bff;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Orbitron', sans-serif;
            background: var(--bg-gradient);
            color: var(--text-color);
            transition: background 0.4s, color 0.4s;
        }

        h1 {
            text-align: center;
            margin-top: 40px;
            font-size: 36px;
            text-shadow: 0 0 10px var(--link-color);
        }

        .settings-container {
            max-width: 800px;
            margin: 40px auto;
            background: var(--form-bg);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 0 15px rgba(0, 255, 255, 0.3);
        }

        label {
            display: block;
            margin-top: 20px;
            font-size: 18px;
            color: var(--label-color);
        }

        input[type="text"],
        input[type="password"],
        input[type="email"] {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            border: none;
            margin-top: 5px;
            background: var(--input-bg);
            color: var(--text-color);
        }

        button {
            margin-top: 25px;
            padding: 12px 25px;
            border: none;
            background: var(--button-bg);
            color: var(--button-hover-color);
            font-weight: bold;
            font-size: 16px;
            border-radius: 10px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: var(--button-hover-bg);
            color: var(--button-hover-color);
            box-shadow: 0 0 15px cyan;
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: var(--link-color);
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        /* Theme toggle button */
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

<h1>🔧 Admin Settings</h1>

<div class="settings-container">
    <form action="#" method="POST">
        <label for="admin_name">Admin Name</label>
        <input type="text" id="admin_name" name="admin_name" value="Ayush Admin">

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="admin@example.com">

        <label for="password">Change Password</label>
        <input type="password" id="password" name="password">

        <button type="submit">Save Changes</button>
    </form>

    <a href="dashboard.php" class="back-link">⬅️ Back to Dashboard</a>
</div>

<script>
    const toggleBtn = document.getElementById("themeToggle");
    const body = document.body;

    function updateIcon() {
        toggleBtn.textContent = body.classList.contains("dark") ? "☀️" : "🌙";
    }

    // Load theme from localStorage
    const savedTheme = localStorage.getItem("theme");
    if (savedTheme === "dark") {
        body.classList.add("dark");
    } else if (savedTheme === "light") {
        body.classList.add("light");
    }
    updateIcon();

    // Toggle theme
    toggleBtn.addEventListener("click", () => {
        body.classList.toggle("light");
        body.classList.toggle("dark");

        const theme = body.classList.contains("dark") ? "dark" : "light";
        localStorage.setItem("theme", theme);
        updateIcon();
    });
</script>

</body>
</html>
