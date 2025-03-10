<?php
$errors = [];
if (isset($_GET["errors"])) {
    $errors = $_GET["errors"];
    $errors =  json_decode($errors, true);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add New User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background: linear-gradient(to right, #6D4C41, #8D6E63);
          
            font-family: 'Arial', sans-serif;
            color: #fff;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding-top: 50px;
   
            padding-bottom: 50px;
        
        }

        .card {
            background-color: #FFF8E1;
                   border-radius: 15px;
            width: 550px;
          
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            
        }

        .card-header {
            background-color: #5D4037;
         
            color: #FFF;
            text-align: center;
            padding: 10px;
            border-radius: 10px 10px 0 0;
        }

        h3 {
            font-size: 24px;
            font-weight: bold;
        }

        .form-label {
            font-size: 16px;
            color: #4E342E;
            
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #6D4C41;
            margin-bottom: 15px;
         
            padding: 10px;
        }

        .form-control:focus {
            box-shadow: 0 0 8px rgba(99, 61, 33, 0.8);
            border-color: #FFC107;
         
        }

        .form-control::placeholder {
            color: #9E9E9E;
        }

        .btn-dark {
            background-color: #6D4C41;
            border: none;
            font-weight: bold;
            padding: 12px 20px;
            width: 100%;
            border-radius: 8px;
            font-size: 18px;
            transition: all 0.3s ease;
        }

        .btn-dark:hover {
            background-color: #5D4037;
            opacity: 0.9;
        }

        .eye-icon {
            position: absolute;
            right: 10px;
            top: 35px;
            cursor: pointer;
            font-size: 18px;
        }

        .alert-danger {
            font-size: 14px;
            color: #D32F2F;
        
        }

        small {
            font-size: 14px;
        }

        .mb-3 {
            position: relative;
        }
        nav {
    background-color: #3b2f23 !important;
    z-index: 999;
}

nav a {
    color: white !important;
}

nav a:hover {
    color: #d2ab86 !important;
}
body{
        background: linear-gradient(to right, #4E342E, #8D6E63);
    }
    </style>

</head>

<body>



    <div class="card">
        <div class="card-header">
            <h3>Add New User</h3>
        </div>

        <form method="POST" action="dp.php" enctype="multipart/form-data" onsubmit="return validatePasswords()">
         
            <div class="mb-3">
                <label class="form-label" for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control" required placeholder="Enter Username">
            </div>

    
            <div class="mb-3">
                <label class="form-label" for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" required placeholder="Enter Email">
            </div>

            
            <div class="mb-3 position-relative">
                <label class="form-label" for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required placeholder="Enter Password">
                <span class="eye-icon" onclick="togglePassword('password')">👁️</span>
            </div>

      
            <div class="mb-3 position-relative">
                <label class="form-label" for="confirm_password">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" required placeholder="Confirm Password">
                <span class="eye-icon" onclick="togglePassword('confirm_password')">👁️</span>
                <small id="passwordError" class="text-danger d-none">Passwords do not match!</small>
            </div>

           
            <div class="mb-3">
                <label class="form-label" for="roomno">Room Number</label>
                <input type="text" name="roomno" id="roomno" class="form-control" required placeholder="Enter Room Number">
            </div>

   
            <div class="mb-3">
                <label class="form-label" for="profile_picture">Profile Picture</label>
                <input type="file" name="img" id="profile_picture" class="form-control" required />
            </div>

            <button type="submit" class="btn btn-dark">➕ Add User</button>
        </form>
    </div>

    <script>
        function validatePasswords() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirm_password").value;
            var errorText = document.getElementById("passwordError");

            if (password !== confirmPassword) {
                errorText.classList.remove("d-none");
                return false;
            } else {
                errorText.classList.add("d-none");
                return true;
            }
        }

        function togglePassword(fieldId) {
            var field = document.getElementById(fieldId);
            field.type = (field.type === "password") ? "text" : "password";
        }
    </script>

</body>

</html>