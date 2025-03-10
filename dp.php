<?php
$errors = [];

if (isset($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $errors["email"] = "Invalid email format.";
}

if (isset($_POST['username']) && strlen($_POST['username']) < 4) {
    $errors["username"] = "Username must be more than 4 characters.";
}

if (isset($_POST['password'])) {
    $password = $_POST['password'];

    if (!preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{8,}$/", $password)) {
        $errors["password"] = "Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character.";
    }
}

if (isset($_FILES['img']) && $_FILES['img']['size'] < 500000) {
    $errors["img"] = "Please choose a larger image.";
}

if (count($errors) > 0) {
    $error = json_encode($errors);
    header("Location: register.php?errors=" . urlencode($error));
    exit();
} else {
    try {
        include('databaseconnection.php');
        
        $username = validate($_POST['username']);
        $email = validate($_POST['email']);
        $password = validate($_POST['password']);
        $roomno = validate($_POST['roomno']);

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $img = null;
        if (isset($_FILES['img']) && $_FILES['img']['error'] === 0) {
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
            $max_size = 2 * 1024 * 1024; 

            if (in_array($_FILES['img']['type'], $allowed_types) && $_FILES['img']['size'] <= $max_size) {
                $img = uniqid() . "_" . basename($_FILES['img']['name']);
                move_uploaded_file($_FILES['img']['tmp_name'], "img/" . $img);
            } else {
                die("Invalid file type or size exceeds 2MB.");
            }
        }

        $stm = $connection->prepare("INSERT INTO users (username, email, password, roomno, profile_picture) VALUES (?, ?, ?, ?, ?)");
        $stm->execute([$username, $email, $hashed_password, $roomno, $img]);

        header("Location: list.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
