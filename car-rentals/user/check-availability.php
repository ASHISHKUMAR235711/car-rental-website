<?php
include('../includes/db.php');

if (isset($_POST['from_date'], $_POST['to_date'])) {
    $from = $_POST['from_date'];
    $to = $_POST['to_date'];

    $query = "SELECT * FROM vehicles WHERE id NOT IN (

                SELECT vehicle_id FROM bookings 
                WHERE ('$from' BETWEEN from_date AND to_date) 
                   OR ('$to' BETWEEN from_date AND to_date) 
                   OR (from_date BETWEEN '$from' AND '$to')
                   OR (to_date BETWEEN '$from' AND '$to')
              )";

    $result = mysqli_query($conn, $query);
    $availableCars = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Check Availability</title>
    <style>
        body {
            background: #f2f2f2;
            font-family: Arial;
            padding: 40px;
        }

        .container {
            background: #fff;
            padding: 30px;
            width: 600px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 0 12px rgba(0,0,0,0.2);
        }

        input {
            padding: 10px;
            margin-bottom: 15px;
            width: 100%;
        }

        button {
            padding: 12px;
            width: 100%;
            background-color: #00a8ff;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 6px;
        }

        table {
            margin-top: 20px;
            width: 100%;
            border-collapse: collapse;
            background: #fff;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #00a8ff;
            color: white;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Check Vehicle Availability</h2>
    <form method="POST">
        <input type="date" name="from_date" required>
        <input type="date" name="to_date" required>
        <button type="submit">Check Availability</button>
    </form>

    <?php if (!empty($availableCars)): ?>
        <h3>Available Cars:</h3>
        <table>
            <tr>
                <th>Brand</th>
                <th>Model</th>
                <th>Number Plate</th>
            </tr>
            <?php foreach ($availableCars as $car): ?>
                <tr>
                    <td><?php echo htmlspecialchars($car['brand']); ?></td>
                    <td><?php echo htmlspecialchars($car['model']); ?></td>
                    <td><?php echo htmlspecialchars($car['number_plate']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php elseif ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
        <p>No cars available in this date range.</p>
    <?php endif; ?>
</div>

</body>
</html>
