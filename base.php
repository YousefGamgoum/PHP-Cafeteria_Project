<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Cafeteria Style</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 9999;
            width: 700px;
            height: 455px;
            border-radius: 18px;
            animation: fadeIn 0.3s cubic-bezier(0.23, 1, 0.32, 1);
            overflow: hidden;
            box-sizing: border-box;
        }

        .popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 9998;
            animation: fadeInOverlay 0.3s ease;
        }

        .popup-close-btn {
            top: 12px;
            right: 12px;
            width: 32px;
            height: 32px;
        }

        .popup-close-btn::before,
        .popup-close-btn::after {
            width: 16px;
            height: 2px;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translate(-50%, -50%) scale(0.98);
            }

            100% {
                opacity: 1;
                transform: translate(-50%, -50%) scale(1);
            }
        }

        .popup::-webkit-scrollbar {
            display: none;
        }

        .popup {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #4E342E, #8D6E63);
            color: #fff;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            background: #FFF8E1;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        .card-header {
            background: #5D4037;
            color: white;
            font-size: 22px;
            text-align: center;
            padding: 15px;
        }

        .dashboard-table th {
            background: #795548 !important;
            color: white;
            font-size: 18px;
        }

        .dashboard-table td {
            color: #4E342E;
            font-size: 16px;
            vertical-align: middle;
        }

        .table-container {
            padding: 20px;
        }

        .dashboard-table img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 3px solid #FFC107;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .btn {
            border-radius: 8px;
            padding: 8px 12px;
            font-size: 14px;
            font-weight: bold;
        }

        .btn-info {
            background-color: #6D4C41;
            border: none;
        }

        .btn-warning {
            background-color: #FFC107;
            border: none;
            color: black;
        }

        .btn-danger {
            background-color: #D84315;
            border: none;
        }

        .btn:hover {
            opacity: 0.8;
        }

        /* Navbar Styles */
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

        /* Footer */
        footer {
            background-color: #3b2f23;
            color: #fff;
            padding: 20px 0;
            text-align: center;
            margin-top: 50px;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand text-uppercase fs-4" href="#">Cafeteria <span class="fs-4 display-5">Dashboard</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-5 d-flex justify-content-end w-100">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                    <a class="nav-link" href="#">Products</a>
                    <a class="nav-link" href="#">Users</a>
                    <a class="nav-link" href="orders.php">Manual Order</a>
                    <a class="nav-link" href="check.php">Checks</a>
                    <a class="nav-link" href="#" aria-disabled="true">Admin</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Dashboard - User Management</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-container">
                            <table class="table table-bordered table-striped dashboard-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Room No</th>
                                        <th>Role</th>
                                        <th>Image</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    try {
                                        $connection = new PDO("mysql:host=localhost;dbname=cafeteriaa", "root", "01158353178");
                                        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                        $data = $connection->query('SELECT * FROM users');
                                        $result = $data->fetchAll(PDO::FETCH_ASSOC);

                                        foreach ($result as $users) {
                                            echo "<tr>";
                                            echo "<td>{$users['id']}</td>";
                                            echo "<td>{$users['username']}</td>";
                                            echo "<td>{$users['email']}</td>";
                                            echo "<td>{$users['roomno']}</td>";
                                            echo "<td>{$users['role']}</td>";
                                            echo "<td><img src='img/{$users['profile_picture']}' alt='Profile Picture'></td>";
                                            echo "<td>
                                            <a href='javascript:void(0);' onclick='openPopup({$users['id']})' class='btn btn-info btn-sm' style='color: #6D4C41 ;background-color: transparent'>
        <i class='fas fa-eye'></i>
    </a>
<a href='edit.php?id={$users['id']}' class='btn btn-warning btn-sm' style='background-color: transparent; border: none;'>
    <i class='fas fa-edit' style='color: #ffc107; font-size: 20px;'></i>
</a>
<a href='delete.php?id={$users['id']}' class='btn btn-danger btn-sm' style='background-color: transparent; border: none;'>
    <i class='fas fa-trash-alt' style='color: #dc3545; font-size: 20px;'></i>
</a>
                                                  </td>";
                                            echo "</tr>";
                                        }
                                    } catch (PDOException $e) {
                                        echo "Error: " . $e->getMessage();
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Cafeteria Dashboard. All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <div class="popup-overlay" id="overlay"></div>
    <div class="popup" id="popup">
        <iframe id="popup-frame" src="" style="width: 100%; height: 100%; border: none;"></iframe>
    </div>

    <script>
        function openPopup(id) {
            var overlay = document.getElementById('overlay');
            var popup = document.getElementById('popup');
            var frame = document.getElementById('popup-frame');
            frame.src = "view.php?id=" + id;
            overlay.style.display = "block";
            popup.style.display = "block";
        }

        function closePopup() {
            var overlay = document.getElementById('overlay');
            var popup = document.getElementById('popup');
            var frame = document.getElementById('popup-frame');
            frame.src = "";
            popup.style.display = "none";
            overlay.style.display = "none";
        }

        document.getElementById('overlay').addEventListener('click', closePopup);
    </script>

</body>

</html>