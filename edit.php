<?php
include('databaseconnection.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $stm = $connection->prepare("SELECT * FROM users WHERE id = ?");
        $stm->execute([$id]);
        $user = $stm->fetch(PDO::FETCH_ASSOC);

        if (isset($_POST['update'])) {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $role = $_POST['role'];
            $img = $_FILES['img']['name'];

            if (!empty($img)) {
                move_uploaded_file($_FILES['img']['tmp_name'], "img/" . $_FILES['img']['name']);
            } else {
                $img = $user['profile_picture'];
            }

            $updateQuery = $connection->prepare("UPDATE users SET username = ?, email = ?, role = ?, profile_picture = ? WHERE id = ?");
            $updateQuery->execute([$username, $email, $role, $img, $id]);

            header("Location: list.php");
            exit();
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
        }

        .container {
            background-color: #FFF8E1;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            width: 600px;
            height: 700px;
        }

        h3 {
            color: #5D4037;
            text-align: center;
            font-size: 26px;
            margin-bottom: 30px;
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

        .btn-success {
            background-color: #6D4C41;
            border: none;
            padding: 12px 20px;
            width: 100%;
            border-radius: 8px;
            font-size: 18px;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .btn-success:hover {
            background-color: #5D4037;
            opacity: 0.9;
        }

        .form-control::placeholder {
            color: #9E9E9E;
        }

        .profile-img {
            margin-left: 225px;
            border-radius: 8px;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 3px solid #FFC107;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        body{
        background: linear-gradient(to right, #4E342E, #8D6E63);
    }
    </style>
</head>

<body>

    <div class="container">
        <h3>Edit User</h3>
        <img src="img/<?php echo $user['profile_picture']; ?>" class="profile-img" width="150" height="100" alt="Profile Picture">
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <input type="text" class="form-control" id="role" name="role" value="<?php echo htmlspecialchars($user['role']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="img" class="form-label">Profile Picture</label>
                <input type="file" class="form-control" id="img" name="img">
            </div>

            <button type="submit" name="update" class="btn btn-success">Update</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>