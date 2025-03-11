

<?php

session_start();
$errors = [];
if (isset($_GET["errors"])) {
    $errors = $_GET["errors"];
    $errors =  json_decode($errors, true);
}

include('databaseconnection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $roomno = $_POST['roomno'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        $stmt = $connection->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);

        if ($stmt->rowCount() > 0) {
            $error_message = "Username already taken!";
        } else {
            $stmt = $connection->prepare("INSERT INTO users (username, password, email, role, roomno) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$username, $hashed_password, $email, $role, $roomno]);

            header("Location: login.php");
            exit();
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
    <title>Register - Cafeteria Style</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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

        .register-container {
            background: #FFF8E1;
            width: 100%;
            max-width: 400px;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .register-container h2 {
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

        .btn-register {
            background-color: #6D4C41;
            color: white;
            font-weight: bold;
            border: none;
            padding: 12px 20px;
            font-size: 16px;
            border-radius: 8px;
            width: 100%;
        }

        .btn-register:hover {
            background-color: #5D4037;
        }

        .register-footer {
            margin-top: 20px;
            font-size: 14px;
            color: #4E342E;
        }

        .register-footer a {
            color: #6D4C41;
            text-decoration: none;
        }

        .register-footer a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .password-container {
            position: relative;
        }

        .password-container i {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }
        body{
        background: linear-gradient(to right, #4E342E, #8D6E63);
    }
    </style>
</head>

<body>

    <div class="register-container">
        <h2>Register to Cafeteria</h2>

        <?php
        if (isset($error_message)) {
            echo "<div class='error-message'>$error_message</div>";
        }
        ?>

        <form action="" method="POST" onsubmit="return validateForm()">
            <div class="form-group">
                <input type="text" name="username" id="username" placeholder="Username" required>
            </div>
            <div class="form-group password-container">
                <input type="password" name="password" id="password" placeholder="Password" required>
                <i class="fas fa-eye" style="color:black;" id="togglePassword" onclick="togglePasswordVisibility()"></i>
            </div>
            <div class="form-group password-container">
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
                <i class="fas fa-eye" style="color:black;" id="toggleConfirmPassword" onclick="toggleConfirmPasswordVisibility()"></i>
            </div>
            <div class="form-group">
                <input type="email" name="email" id="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="text" name="roomno" id="roomno" placeholder="Room No" required>
            </div>
            <div class="form-group">
                <select name="role" id="role" class="form-control" required>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <div id="validation-errors" class="error-message"></div>

            <button type="submit" class="btn-register">Register</button>
        </form>

        <div class="register-footer">
            <p>Already have an account? <a href="login.php">Login</a></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function validateForm() {
            var username = document.getElementById('username').value;
            var password = document.getElementById('password').value;
            var confirmPassword = document.getElementById('confirm_password').value;
            var errors = [];

            var usernameRegex = /^[a-zA-Z0-9]{6,}$/;
            if (!usernameRegex.test(username)) {
                errors.push("Username must be at least 6 characters long and contain only alphanumeric characters.");
            }
            var passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
            if (!passwordRegex.test(password)) {
                errors.push("Password must be at least 8 characters long and contain at least one letter and one number.");
            }

            if (password !== confirmPassword) {
                errors.push("Passwords do not match.");
            }
            var validationErrors = document.getElementById('validation-errors');
            if (errors.length > 0) {
                validationErrors.innerHTML = errors.join("<br>");
                return false;
            }
            return true;
        }

        function togglePasswordVisibility() {
            var passwordField = document.getElementById('password');
            var icon = document.getElementById('togglePassword');
            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = "password";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        function toggleConfirmPasswordVisibility() {
            var confirmPasswordField = document.getElementById('confirm_password');
            var icon = document.getElementById('toggleConfirmPassword');
            if (confirmPasswordField.type === "password") {
                confirmPasswordField.type = "text";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                confirmPasswordField.type = "password";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>

</html>