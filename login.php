<?php
session_start();
include('database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {

        $stmt = $connection->prepare("SELECT id, username, password, role FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        
        if ($user) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                if ($user['role'] == 'admin') {
                    header("Location: ./admin.php");
                } else {
                    header("Location: ./home.php");


                }
                exit();
            } else {
                $error_message = "Incorrect password!";
            }
        } else {
            $error_message = "Username not found!";
        }
    } catch (PDOException $e) {
        $error_message = "Database connection error: " . $e->getMessage();
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Cafeteria Style</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #4E342E, #8D6E63);
            color: #fff;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        .login-container {
            background: #FFF8E1;
            width: 100%;
            max-width: 400px;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .login-container h2 {
            color: #5D4037;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .form-group input {
            padding: 12px;
            margin: 10px 0;
            width: 100%;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 16px;
        }

        .form-group input:focus {
            outline: none;
            border-color: #6D4C41;
        }

        .btn-login {
            background-color: #6D4C41;
            color: white;
            font-weight: bold;
            border: none;
            padding: 12px 20px;
            font-size: 16px;
            border-radius: 8px;
            width: 100%;
        }

        .btn-login:hover {
            background-color: #5D4037;
        }

        .login-footer {
            margin-top: 20px;
            font-size: 14px;
            color: #4E342E;
        }

        .login-footer a {
            color: #6D4C41;
            text-decoration: none;
        }

        .login-footer a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-bottom: 20px;
        }
        body{
        background: linear-gradient(to right, #4E342E, #8D6E63);
    }
    </style>
</head>

<body>

    <div class="login-container">
        <h2>Login to Cafeteria</h2>

        <?php
        if (isset($error_message)) {
            echo "<div class='error-message'>$error_message</div>";
        }
        ?>

        <form action="" method="POST">
            <div class="form-group">
                <input type="text" name="username" id="username" placeholder="Username" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" id="password" placeholder="Password" required>
            </div>
            <button type="submit" class="btn-login">Login</button>
        </form>

        <div class="login-footer">
            <p>Don't have an account? <a href="register.php">Register</a></p>
            <p>Forgot Your Password? <a href="./resetpassword.php">Forget Password</a></p>
            </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>