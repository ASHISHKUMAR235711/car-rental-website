<?php
include('../includes/db.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Users</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-gradient: linear-gradient(145deg, #0f2027, #203a43, #2c5364);
            --text-color: #fff;
            --header-bg: #00f5ff;
            --header-color: #000;
            --row-bg: rgba(255, 255, 255, 0.05);
            --btn-bg: #00f5ff;
            --btn-hover: #00ffff;
            --btn-color: #000;
        }

        body.light {
            --bg-gradient: linear-gradient(145deg, #e0f7fa, #ffffff);
            --text-color: #000;
            --header-bg: #0077ff;
            --header-color: #fff;
            --row-bg: rgba(0, 0, 0, 0.03);
            --btn-bg: #0077ff;
            --btn-hover: #3399ff;
            --btn-color: #fff;
        }

        body {
            background: var(--bg-gradient);
            color: var(--text-color);
            font-family: 'Orbitron', sans-serif;
            text-align: center;
            transition: 0.3s;
        }

        h1 {
            margin-top: 30px;
        }

        table {
            width: 90%;
            margin: 40px auto;
            border-collapse: collapse;
            box-shadow: 0 0 20px rgba(0,255,255,0.2);
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            border: 1px solid var(--header-bg);
        }

        th {
            background-color: var(--header-bg);
            color: var(--header-color);
        }

        tr:nth-child(even) {
            background-color: var(--row-bg);
        }

        a.button {
            display: inline-block;
            margin: 30px auto;
            padding: 12px 30px;
            background: var(--btn-bg);
            color: var(--btn-color);
            text-decoration: none;
            border-radius: 30px;
            font-weight: bold;
            transition: 0.3s;
        }

        a.button:hover {
            background: var(--btn-hover);
            box-shadow: 0 0 10px var(--btn-bg), 0 0 20px var(--btn-bg);
        }

        #themeToggle {
            margin-top: 20px;
            padding: 10px 25px;
            border-radius: 20px;
            background: var(--btn-bg);
            color: var(--btn-color);
            border: none;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        #themeToggle:hover {
            background: var(--btn-hover);
            box-shadow: 0 0 10px var(--btn-bg);
        }
    </style>
</head>
<body>

    <h1>Registered Users</h1>
    <button id="themeToggle">🌗 Toggle Theme</button>

    <table>
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Registered At</th>
        </tr>
        <?php
        $query = "SELECT * FROM users";
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['name']."</td>";
            echo "<td>".$row['email']."</td>";
            echo "<td>".$row['phone']."</td>";
            echo "<td>".$row['reg_date']."</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <a class="button" href="dashboard.php">⬅ Back to Dashboard</a>

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
