<?php
include('databaseconnection.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $stm = $connection->prepare("SELECT * FROM users WHERE id = ?");
        $stm->execute([$id]);
        $data = $stm->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - Cafeteria Style</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Georgia', serif;
        }

        body {

            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 20px;
        }

        .container {
            background: #FFF8E1;
            width: 60%;
            max-width: 411px;
            /* تقليل العرض إلى 300px */
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
            text-align: center;
            overflow: hidden;
            /* منع الشريط الأفقي */
            max-height: 400px;
            /* تقليل الارتفاع الأقصى */
        }

        .container h2 {
            font-size: 18px;
            /* تقليل حجم العنوان */
            margin-bottom: 10px;
            color: #5D4037;
        }

        .user-info {
            list-style: none;
            padding: 0;
        }

        .user-info li {
            padding: 8px;
            margin: 6px 0;
            background: #D7CCC8;
            border-radius: 8px;
            font-size: 14px;
            /* تقليل حجم الخط أكثر */
            font-weight: bold;
            color: #4E342E;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .profile-pic {
            margin-top: 10px;
        }

        .profile-pic img {
            width: 80px;
            /* تقليل الحجم بشكل أكبر */
            height: 80px;
            /* تقليل الحجم بشكل أكبر */
            border-radius: 50%;
            border: 4px solid #FFC107;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>User Profile</h2>
        <ul class="user-info">
            <?php
            if (!empty($data)) {
                if (!empty($data['profile_picture']) && file_exists("img/" . $data['profile_picture'])) {
                    echo "<div class='profile-pic'><img src='img/" . htmlspecialchars($data['profile_picture']) . "' alt='Profile Picture'></div>";
                } else {
                    echo "<li>No Profile Picture Available</li>";
                }
                echo "<li><strong>ID:</strong> " . htmlspecialchars($data['id']) . "</li>";
                echo "<li><strong>Username:</strong> " . htmlspecialchars($data['username']) . "</li>";
                echo "<li><strong>Role:</strong> " . htmlspecialchars($data['role']) . "</li>";
                echo "<li><strong>Email:</strong> " . htmlspecialchars($data['email']) . "</li>";
                echo "<li><strong>Room No:</strong> " . htmlspecialchars($data['roomno']) . "</li>";
            } else {
                echo "<li>No user found</li>";
            }
            ?>
        </ul>
    </div>

</body>

</html>