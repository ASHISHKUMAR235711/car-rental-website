<?php
session_start();
include('../includes/db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM vehicles";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book a Car</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f1f2f6;
            margin: 0;
            padding: 0;
        }

        .main-content {
            max-width: 1100px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #2f3542;
            text-align: center;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 12px;
            overflow: hidden;
        }

        th, td {
            padding: 15px;
            text-align: center;
        }

        th {
            background-color: #2f3542;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f1f2f6;
        }

        tr:hover {
            background-color: #dfe4ea;
        }

        input[type="date"] {
            padding: 6px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 6px 14px;
            background: #1e90ff;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background: #3742fa;
        }
    </style>
</head>
<body>

<?php include('user-layout.php'); ?>

<div class="main-content">
    <h2>🚗 Available Vehicles</h2>
    <table>
        <tr>
            <th>Brand</th>
            <th>Model</th>
            <th>Number Plate</th>
            <th>Overview</th>
            <th>Price/Day</th>
            <th>Action</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['brand']); ?></td>
                <td><?php echo htmlspecialchars($row['model']); ?></td>
                <td><?php echo htmlspecialchars($row['number_plate']); ?></td>
                <td><?php echo htmlspecialchars($row['overview']); ?></td>
                <td>₹<?php echo htmlspecialchars($row['price']); ?></td>
                <td>
                    <form method="POST" action="process-booking.php" style="display:inline;">
                        <input type="hidden" name="car_id" value="<?php echo $row['id']; ?>">
                        <input type="date" name="from_date" required>
                        <input type="date" name="to_date" required>
                        <button type="submit">Book</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>
</html>
