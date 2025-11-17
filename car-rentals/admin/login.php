<?php
include('../includes/db.php');
session_start();

$msg = "";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM admin WHERE username='$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $admin = mysqli_fetch_assoc($result);
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_user'] = $admin['username'];
            header("Location: dashboard.php");
            exit();
        } else {
            $msg = "❌ Invalid password!";
        }
    } else {
        $msg = "⚠️ Admin not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login | Car Rental System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root {
            --primary: #00ffe1;
            --primary-dark: #00cccc;
            --bg: #0a0a0a;
            --card-bg: #1a1a1a;
            --input-bg: #111;
            --error: #ff4d4d;
            --text: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 1rem;
            background-image: radial-gradient(circle at 20% 30%, rgba(0, 255, 225, 0.05), transparent),
                              radial-gradient(circle at 80% 80%, rgba(0, 255, 225, 0.05), transparent);
        }

        .login-card {
            position: relative;
            max-width: 420px;
            width: 100%;
            padding: 2.5rem;
            border-radius: 18px;
            background: var(--card-bg);
            box-shadow: 0 0 30px rgba(0, 255, 225, 0.15);
            z-index: 1;
            animation: fadeInUp 0.8s ease;
            overflow: hidden;
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, var(--primary), var(--primary-dark), var(--primary));
            z-index: -2;
            border-radius: 20px;
            animation: rotateBorder 6s linear infinite;
        }

        .login-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--card-bg);
            border-radius: 16px;
            z-index: -1;
        }

        .login-card h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: var(--primary);
            text-shadow: 0 0 10px rgba(0, 255, 225, 0.4);
        }

        .input-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .input-group input {
            width: 100%;
            padding: 14px 12px 10px 12px;
            background: var(--input-bg);
            border: 1px solid rgba(0, 255, 225, 0.3);
            border-radius: 8px;
            color: var(--text);
            font-size: 1rem;
            transition: 0.3s ease;
        }

        .input-group label {
            position: absolute;
            top: 12px;
            left: 14px;
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.6);
            pointer-events: none;
            transition: 0.3s ease;
        }

        .input-group input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 10px rgba(0, 255, 225, 0.3);
        }

        .input-group input:focus + label,
        .input-group input:not(:placeholder-shown) + label {
            top: -8px;
            left: 10px;
            font-size: 0.75rem;
            background: var(--card-bg);
            padding: 0 5px;
            color: var(--primary);
        }

        button {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 8px;
            background: var(--primary);
            color: #000;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: 0.3s ease;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        button:hover {
            background: var(--primary-dark);
            box-shadow: 0 0 15px rgba(0, 255, 225, 0.5);
            transform: translateY(-1px);
        }

        .error-msg {
            margin-top: 1rem;
            color: var(--error);
            text-align: center;
            font-weight: 500;
            min-height: 1.2rem;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes rotateBorder {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 2rem 1.5rem;
            }

            .login-card h2 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-card">
        <h2>Admin Login</h2>
        <form method="POST">
            <div class="input-group">
                <input type="text" name="username" id="username" required placeholder=" " />
                <label for="username">Username</label>
            </div>
            <div class="input-group">
                <input type="password" name="password" id="password" required placeholder=" " />
                <label for="password">Password</label>
            </div>
            <button type="submit" name="login">Login</button>
            <div class="error-msg"><?php echo $msg; ?></div>
        </form>
    </div>
</body>
</html>
