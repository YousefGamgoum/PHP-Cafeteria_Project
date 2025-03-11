<?php
session_start();
include('database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        $error_message = "Passwords do not match!";
    } else {
        try {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $stmt = $connection->prepare("UPDATE users SET password = ? WHERE username = ?");
            // $stmt->bind_param("ss", $hashed_password, $username);
            
            if ($stmt->execute([$hashed_password, $username])) {
                $success_message = "Password successfully reset. You can now <a href='login.php'>Login</a>.";
            } else {
                $error_message = "Error updating password. Please try again.";
            }
        } catch (PDOException $e) {
            $error_message = "Database error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
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
        .reset-container {
            background: #FFF8E1;
            width: 100%;
            max-width: 400px;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        .error-message {
            color: red;
            font-size: 14px;
            margin-bottom: 20px;
        }
        .success-message {
            color: green;
            font-size: 14px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="reset-container">
        <h2 style="color:#5D4037;">Reset Password</h2>
        <?php
        if (isset($error_message)) {
            echo "<div class='error-message'>$error_message</div>";
        }
        if (isset($success_message)) {
            echo "<div class='success-message'>$success_message</div>";
        }
        ?>
        <form action="" method="POST">
            <div class="form-group mt-4">
                <input type="text" name="username" class="form-control" placeholder="Enter your username" required>
            </div>
            <div class="form-group mt-4">
                <input type="password" name="new_password" class="form-control" placeholder="New Password" required>
            </div>
            <div class="form-group mt-4">
                <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" required>
            </div>
            <button style="background-color: #6D4C41;
            color: white;" type="submit" class="btn mt-4">Reset Password</button>
        </form>
    </div>
</body>
</html>
