<?php
session_start();
include('../includes/db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$query = "SELECT bookings.*, vehicles.brand, vehicles.model, vehicles.number_plate 
          FROM bookings 
          JOIN vehicles ON bookings.vehicle_id = vehicles.id 
          WHERE bookings.user_id = $user_id 
          ORDER BY bookings.id DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Bookings</title>
    <style>
        .pay-link {
            background-color: #28a745;
            color: white;
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
        }

        .pay-link:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<?php include('user-layout.php'); ?>

<div class="main-content">
    <h2 style="color: #2f3542;">My Bookings</h2>

    <?php if (isset($_GET['msg'])): ?>
        <div style="background: #d4edda; color: #155724; padding: 10px 20px; margin: 20px auto; width: 80%; border: 1px solid #c3e6cb; border-radius: 5px;">
            <?php echo htmlspecialchars($_GET['msg']); ?>
        </div>
    <?php endif; ?>

    <table style="width: 100%; background: white; border-collapse: collapse; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); overflow: hidden;">
        <tr style="background-color: #2f3542; color: white;">
            <th style="padding: 10px;">Car</th>
            <th>Number Plate</th>
            <th>From</th>
            <th>To</th>
            <th>Status</th>
            <th>Payment</th>
            <th>Action</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr style="text-align: center; border-bottom: 1px solid #ddd;">
                <td><?php echo htmlspecialchars($row['brand'] . ' ' . $row['model']); ?></td>
                <td><?php echo htmlspecialchars($row['number_plate']); ?></td>
                <td><?php echo htmlspecialchars($row['from_date']); ?></td>
                <td><?php echo htmlspecialchars($row['to_date']); ?></td>
                <td style="color: 
                    <?php 
                        echo ($row['status'] == 'confirmed') ? 'green' : 
                             (($row['status'] == 'cancelled') ? 'red' : 'orange');
                    ?>;
                    font-weight: bold;">
                    <?php echo ucfirst($row['status']); ?>
                </td>
                <td>
                    <?php
                        if ($row['payment_status'] == 'paid') {
                            echo "<span style='color: green; font-weight: bold;'>Paid</span>";
                        } else {
                            echo "<a class='pay-link' href='payment.php?booking_id=" . $row['id'] . "'>Pay Now</a>";
                        }
                    ?>
                </td>
                <td>
                    <?php if ($row['status'] !== 'cancelled'): ?>
                        <a href="cancel-booking.php?id=<?php echo $row['id']; ?>" 
                           onclick="return confirm('Are you sure you want to cancel this booking?');" 
                           style="color: red; text-decoration: none; font-weight: bold;">Cancel</a>
                    <?php else: ?>
                        —
                    <?php endif; ?>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>
</html>
