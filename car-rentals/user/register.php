<?php
include('../includes/db.php');

$msg = "";

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $check_query = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
    if (mysqli_num_rows($check_query) > 0) {
        $msg = "Email already registered!";
    } else {
        $query = "INSERT INTO users (name, email, password, phone) 
                  VALUES ('$name', '$email', '$hashed_password', '$phone')";
        if (mysqli_query($conn, $query)) {
            $msg = "Registration successful!";
        } else {
            $msg = "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Registration</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #667eea, #764ba2);
            font-family: 'Roboto', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #fff;
        }

        .register-box {
            background: rgba(255, 255, 255, 0.1);
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
            width: 100%;
            max-width: 400px;
        }

        .register-box h2 {
            text-align: center;
            margin-bottom: 25px;
            font-weight: 700;
        }

        .register-box input {
            width: 100%;
            padding: 12px;
            margin: 12px 0;
            border: none;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.9);
            color: #333;
            font-size: 16px;
        }

        .register-box button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background: linear-gradient(135deg, #43e97b, #38f9d7);
            font-size: 16px;
            font-weight: bold;
            color: #fff;
            cursor: pointer;
            transition: 0.3s ease;
        }

        .register-box button:hover {
            transform: scale(1.05);
        }

        .msg {
            text-align: center;
            margin-top: 15px;
            font-weight: bold;
            color: yellow;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
        }

        .login-link a {
            background: #fff;
            color: #333;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s ease;
        }

        .login-link a:hover {
            background: #ffd700;
            color: #000;
        }

        @media (max-width: 480px) {
            .register-box {
                margin: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="register-box">
        <h2>Create Account</h2>
        <form method="POST">
            <input type="text" name="name" placeholder="Full Name" required />
            <input type="email" name="email" placeholder="Email" required />
            <input type="text" name="phone" placeholder="Phone Number" required />
            <input type="password" name="password" placeholder="Password" required />
            <button type="submit" name="register">Register</button>
        </form>
        <p class="msg"><?php echo $msg; ?></p>

        <!-- Always show login button -->
        <div class="login-link">
            <a href="login.php">Already have an account? Login</a>
        </div>
    </div>
</body>
</html>
