<?php

//c
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//c

session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}
include('../includes/db.php');

if (isset($_POST['submit'])) {
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $overview = $_POST['overview'];
    $price = $_POST['price'];
    $number_plate = $_POST['number_plate'];


    $sql = "INSERT INTO vehicles (brand, model, overview, price, number_plate) 
        VALUES ('$brand', '$model', '$overview', '$price', '$number_plate')";

    if (mysqli_query($conn, $sql)) {
        $msg = "<span class='success'>🚗 Vehicle added successfully!</span>";
    } else {
        $msg = "<span class='error'>❌ Error: " . mysqli_error($conn) . "</span>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Vehicle</title>
    <style>
        :root {
            --bg-color: linear-gradient(to right, #e0f7fa, #e1bee7);
            --text-color: #333;
            --form-bg: #fff;
            --input-border: #ccc;
            --focus-border: #6200ea;
            --focus-shadow: #b388ff;
            --button-bg: #6200ea;
            --button-hover: #4b00c2;
            --button-shadow: #9c47ff;
            --button-inset-shadow: #4b00c2;
            --success-bg: #d4edda;
            --success-color: #155724;
            --success-border: #c3e6cb;
            --error-bg: #f8d7da;
            --error-color: #721c24;
            --error-border: #f5c6cb;
        }

        body.light {
            --bg-color: linear-gradient(to right, #ffffff, #e0e0e0);
            --text-color: #000;
            --form-bg: #fff;
            --input-border: #aaa;
            --focus-border: #2196f3;
            --focus-shadow: #90caf9;
            --button-bg: #1976d2;
            --button-hover: #0d47a1;
            --button-shadow: #42a5f5;
            --button-inset-shadow: #0d47a1;
            --success-bg: #d4edda;
            --success-color: #155724;
            --success-border: #c3e6cb;
            --error-bg: #f8d7da;
            --error-color: #721c24;
            --error-border: #f5c6cb;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: var(--bg-color);
            padding: 40px;
            color: var(--text-color);
            transition: background 0.3s, color 0.3s;
        }

        h2 {
            text-align: center;
            font-size: 32px;
            text-shadow: 1px 1px 2px #aaa;
            margin-bottom: 30px;
        }

        form {
            background: var(--form-bg);
            padding: 30px;
            max-width: 500px;
            margin: auto;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.15);
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        input, textarea {
            width: 100%;
            padding: 12px;
            margin-top: 15px;
            border: 1px solid var(--input-border);
            border-radius: 8px;
            font-size: 15px;
            transition: 0.3s ease;
            background: #fff;
            color: inherit;
        }

        input:focus, textarea:focus {
            border-color: var(--focus-border);
            box-shadow: 0 0 10px var(--focus-shadow);
            outline: none;
        }

        button {
            padding: 12px 25px;
            background: var(--button-bg);
            color: white;
            border: none;
            font-size: 16px;
            border-radius: 25px;
            cursor: pointer;
            margin-top: 20px;
            transition: 0.3s ease;
            box-shadow: 0 0 15px var(--button-shadow);
        }

        button:hover {
            background: var(--button-hover);
            box-shadow: 0 0 20px var(--button-shadow), 0 0 10px var(--button-inset-shadow) inset;
        }

        .success, .error {
            display: block;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 8px;
            font-weight: bold;
            text-align: center;
        }

        .success {
            background-color: var(--success-bg);
            color: var(--success-color);
            border: 1px solid var(--success-border);
        }

        .error {
            background-color: var(--error-bg);
            color: var(--error-color);
            border: 1px solid var(--error-border);
        }

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

<h2>➕ Add New Vehicle</h2>

<form method="POST">
    <?php if (isset($msg)) echo $msg; ?>
    <input type="text" name="brand" placeholder="Brand (e.g., Honda)" required>
    <input type="text" name="model" placeholder="Model (e.g., Civic)" required>
    <textarea name="overview" placeholder="Overview" rows="4" required></textarea>
    <input type="number" name="price" placeholder="Price per day (in ₹)" required>
    <input type="text" name="number_plate" placeholder="Number Plate (e.g., MH12AB1234)" required>

    <button type="submit" name="submit">Add Vehicle</button>
</form>

<script>
    const toggleBtn = document.getElementById("themeToggle");
    const body = document.body;

    function updateIcon() {
        toggleBtn.textContent = body.classList.contains("dark") ? "☀️" : "🌙";
    }

    const savedTheme = localStorage.getItem("theme");
    if (savedTheme === "dark") {
        body.classList.add("dark");
    } else if (savedTheme === "light") {
        body.classList.add("light");
    }
    updateIcon();

    toggleBtn.addEventListener("click", () => {
        body.classList.toggle("dark");
        body.classList.toggle("light");

        const theme = body.classList.contains("dark") ? "dark" : "light";
        localStorage.setItem("theme", theme);
        updateIcon();
    });
</script>

</body>
</html>
