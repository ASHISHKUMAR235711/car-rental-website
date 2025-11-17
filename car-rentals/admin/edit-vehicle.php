<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}
include('../includes/db.php');

// Get vehicle ID
$id = $_GET['id'] ?? null;
if (!$id) {
    die("No vehicle selected.");
}

// Fetch vehicle data
$result = mysqli_query($conn, "SELECT * FROM vehicles WHERE id='$id'");
$vehicle = mysqli_fetch_assoc($result);

// Update logic
if (isset($_POST['update'])) {
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $overview = $_POST['overview'];
    $price = $_POST['price'];

    $updateQuery = "UPDATE vehicles SET brand='$brand', model='$model', overview='$overview', price='$price' WHERE id='$id'";
    if (mysqli_query($conn, $updateQuery)) {
        $msg = "✅ Vehicle updated successfully!";
        header("Location: manage-vehicles.php");
        exit();
    } else {
        $msg = "❌ Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Vehicle</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; padding: 20px; }
        form { background: white; padding: 20px; max-width: 500px; margin: auto; border-radius: 8px; }
        input, textarea { width: 100%; padding: 10px; margin-top: 10px; }
        button { padding: 10px 20px; background: #007bff; color: white; border: none; margin-top: 15px; }
    </style>
</head>
<body>

<h2 style="text-align:center;">Edit Vehicle</h2>

<form method="POST">
    <?php if (isset($msg)) echo "<p>$msg</p>"; ?>
    <input type="text" name="brand" value="<?= $vehicle['brand'] ?>" required>
    <input type="text" name="model" value="<?= $vehicle['model'] ?>" required>
    <textarea name="overview" required><?= $vehicle['overview'] ?></textarea>
    <input type="number" name="price" value="<?= $vehicle['price'] ?>" required>
    <button type="submit" name="update">Update Vehicle</button>
</form>

</body>
</html>
