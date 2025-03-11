<?php
// Function to connect to the database
function getConnection()
{
    $host = 'localhost';
    $dbname = 'php project';
    $username = 'root';
    $password = 'Root@123';

    try {
        $connection = new PDO(
            "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
            $username,
            $password,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
        );
        error_log("Successfully connected to the database");
        return $connection;
    } catch (PDOException $e) {
        error_log("Connection error: " . $e->getMessage());
        die("Database connection error: " . $e->getMessage());
    }
}

// Function to get active orders
function getActiveOrders($userId = null)
{
    try {
        $connection = getConnection();

        $sql = "SELECT 
                    o.order_id,
                    DATE_FORMAT(o.created_at, '%Y/%m/%d %h:%i %p') as date,
                    u.username as name,
                    r.room_number as room,
                    o.total_price,
                    LOWER(o.status) as status
                FROM orders o
                LEFT JOIN users u ON o.user_id = u.id
                LEFT JOIN rooms r ON o.room_id = r.room_number
                WHERE o.status NOT IN ('done', 'delivered')";

        $params = [];
        if ($userId && is_numeric($userId)) {
            $sql .= " AND o.user_id = :user_id";
            $params[':user_id'] = (int)$userId;
        }

        $sql .= " ORDER BY o.created_at DESC";

        $stmt = $connection->prepare($sql);
        $stmt->execute($params);
        $result = $stmt->fetchAll();

        if (empty($result)) {
            error_log("No active orders found");
        } else {
            error_log("Fetched " . count($result) . " orders");
        }

        return $result;
    } catch (PDOException $e) {
        error_log("Error fetching orders: " . $e->getMessage());
        return [];
    }
}

// Function to get order details
function getOrderDetails($orderId)
{
    try {
        $connection = getConnection();

        $sql = "SELECT 
                    o.order_id,
                    DATE_FORMAT(o.created_at, '%Y/%m/%d %h:%i %p') as date,
                    u.username as name,
                    u.email,
                    r.room_number as room,
                    o.total_price,
                    LOWER(o.status) as status
                FROM orders o
                LEFT JOIN users u ON o.user_id = u.id
                LEFT JOIN rooms r ON o.room_id = r.room_number
                WHERE o.order_id = :order_id";

        $stmt = $connection->prepare($sql);
        $stmt->execute([':order_id' => $orderId]);
        $result = $stmt->fetch();

        if (!$result) {
            error_log("Order not found for order_id: " . $orderId);
        }

        return $result;
    } catch (PDOException $e) {
        error_log("Error fetching order details: " . $e->getMessage());
        return null;
    }
}

// Function to get order items
function getOrderItems($orderId)
{
    try {
        $connection = getConnection();
        $sql = "SELECT 
                    p.name,
                    p.price,
                    oi.quantity,
                    (oi.unit_price * oi.quantity) as total
                FROM order_items oi
                INNER JOIN products p ON oi.product_id = p.id
                WHERE oi.order_id = :order_id";

        $stmt = $connection->prepare($sql);
        $stmt->execute([':order_id' => $orderId]);
        $result = $stmt->fetchAll();

        if (empty($result)) {
            error_log("No items found for order_id: " . $orderId);
        }

        return $result;
    } catch (PDOException $e) {
        error_log("Error fetching order items: " . $e->getMessage());
        return [];
    }
}

// Function to update order status
function updateOrderStatus($orderId, $status)
{
    try {
        $connection = getConnection();

        $sql = "UPDATE orders 
                SET status = ?
                WHERE order_id = ?";

        $stmt = $connection->prepare($sql);
        $success = $stmt->execute([$status,$orderId]);

        if ($success) {
            error_log("Status updated successfully for order_id: " . $orderId);
        } else {
            error_log("Failed to update status for order_id: " . $orderId);
        }

        return $success;
    } catch (PDOException $e) {
        error_log("Error updating status: " . $e->getMessage());
        return false;
    }
}

// Handle POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['status'], $_POST['order_id'])) {
        $orderId = (int)$_POST['order_id'];
        $status = htmlspecialchars($_POST['status']);

        if (updateOrderStatus($orderId, $status)) {
            header("Location: " . $_SERVER['REQUEST_URI']);
            exit();
        } else {
            echo "<div class='alert alert-danger'>Failed to update status</div>";
        }
    }
}

// Get required data
$filteredUserId = isset($_GET['user_id']) ? (int)$_GET['user_id'] : null;
$selectedOrderId = isset($_GET['order_id']) ? (int)$_GET['order_id'] : null;

$activeOrders = getActiveOrders($filteredUserId);
$orderDetails = $selectedOrderId ? getOrderDetails($selectedOrderId) : null;
$orderItems = $selectedOrderId ? getOrderItems($selectedOrderId) : [];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Control Panel - Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        :root {
            --primary-color: #6D4C41;
            --secondary-color: #FFF8E1;
            --accent-color: #D4A373;
            --text-color: #FFF8E1;
            --card-bg: #FFFFFF;
            --shadow-color: rgba(0, 0, 0, 0.2);
        }

        body {
            background-color: var(--primary-color);
            color: var(--text-color);
            min-height: 100vh;
            font-family: Arial, sans-serif;
        }

        .container {
            background-color: var(--primary-color);
        }

        .order-card {
            background: var(--card-bg);
            border-radius: 10px;
            transition: transform 0.2s;
            box-shadow: 0 4px 8px var(--shadow-color);
            color: #333;
        }

        .order-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px var(--shadow-color);
        }

        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: bold;
            color: #FFF8E1;
        }

        .status-pending {
            background: #8B5A2B;
        }

        .status-confirmed {
            background: #A67B5B;
        }

        .status-shipped {
            background: #D4A373;
        }

        .btn-primary {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
            color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: #C68E5A;
            border-color: #C68E5A;
        }

        .btn-secondary {
            background-color: #8B5A2B;
            border-color: #8B5A2B;
            color: var(--text-color);
        }

        .btn-secondary:hover {
            background-color: #734B24;
            border-color: #734B24;
        }

        .btn-outline-primary {
            color: var(--accent-color);
            border-color: var(--accent-color);
        }

        .btn-outline-primary:hover {
            background-color: var(--accent-color);
            color: var(--primary-color);
        }

        .btn-warning {
            background-color: #E8B923;
            color: var(--primary-color);
            border-color: #E8B923;
        }

        .btn-warning:hover {
            background-color: #D4A017;
            border-color: #D4A017;
        }

        .card {
            background-color: var(--card-bg);
            color: #333;
        }

        .alert-info {
            background-color: #E8D5B9;
            color: var(--primary-color);
            border-color: #D4A373;
        }

        .alert-danger {
            background-color: #D9534F;
            color: #FFF8E1;
            border-color: #C9302C;
        }

        h1,
        h4,
        h5 {
            color: var(--text-color);
        }

        .table {
            background-color: var(--card-bg);
            color: #333;
        }

        .table th {
            background-color: #F5E8C7;
            color: var(--primary-color);
        }

        .form-select {
            background-color: var(--secondary-color);
            color: var(--primary-color);
            border-color: var(--accent-color);
        }
        .custom{
            color: #5D4037;
        }
    </style>
    <style>
    nav {
    background-color: #3b2f23 !important;
    z-index: 999;
}
.navStyle{
    background-color: #3b2f23 !important;
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
<nav class="navbar navbar-expand-lg" >
        <div class="container navStyle">
            <a class="navbar-brand text-uppercase fs-4" href="#">Coffee <span class="fs-4 display-5">Blend</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-5 d-flex justify-content-end w-100">
                    <a class="nav-link active" aria-current="page" href="./admin.php">Home</a>
                    <a class="nav-link" href="./VIewProducts.php">Products</a>
                    <a class="nav-link" href="./list.php">Users</a>
                    <a class="nav-link" href="./orders.php">Manual Order</a>
                    <a class="nav-link" href="./check.php">Checks</a>
                    <li class="nav-item "><a class=" nav-link  d-flex align-items-center" id="logoutBtn" href="logout.php"><i class="bi bi-box-arrow-left text-end  fw-bolder mx-1"></i>Logout</a></li>
                        </div>
            </div>
        </div>
    </nav>
    <div class="container py-5">
        <div class="row mb-4">
            <div class="col-md-8">
                <h1>Order Management</h1>
            </div>
            <div class="col-md-4">
                <form method="GET" class="d-flex gap-2">
                    <select name="user_id" class="form-select">
                        <option value="">All Users</option>
                        <?php
                        $users = getConnection()->query("SELECT id, username FROM users")->fetchAll();
                        foreach ($users as $user) {
                            $selected = $user['id'] == $filteredUserId ? 'selected' : '';
                            echo "<option value='{$user['id']}' $selected>{$user['username']}</option>";
                        }
                        ?>
                    </select>
                    <button type="submit" class="btn btn-warning">Filter</button>
                </form>
            </div>
        </div>

        <?php if ($selectedOrderId && $orderDetails): ?>
            <!-- Order Details -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="custom">Order Details #<?= htmlspecialchars($orderDetails['order_id']) ?></h4>
                    <a href="?" class="btn btn-secondary">Back to List</a>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5 class="custom">Customer Information</h5>
                            <p><strong>Name:</strong> <?= htmlspecialchars($orderDetails['name'] ?? 'N/A') ?></p>
                            <p><strong>Email:</strong> <?= htmlspecialchars($orderDetails['email'] ?? 'N/A') ?></p>
                        </div>
                        <div class="col-md-6">
                            <h5 class="custom">Delivery Information</h5>
                            <p ><strong>Room:</strong> <?= htmlspecialchars($orderDetails['room'] ?? 'N/A') ?></p>
                            <p class="custom"><strong >Order Time:</strong> <?= htmlspecialchars($orderDetails['date']) ?></p>
                        </div>
                    </div>

                    <h5 class="custom">Order Items</h5>
                    <?php if (empty($orderItems)): ?>
                        <p>No items found for this order.</p>
                    <?php else: ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($orderItems as $item): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($item['name']) ?></td>
                                        <td><?= number_format($item['price'], 2) ?> EGP</td>
                                        <td><?= htmlspecialchars($item['quantity']) ?></td>
                                        <td><?= number_format($item['total'], 2) ?> EGP</td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3">Total</th>
                                    <th><?= number_format($orderDetails['total_price'], 2) ?> EGP</th>
                                </tr>
                            </tfoot>
                        </table>
                    <?php endif; ?>

                    <form method="POST" class="mt-4">
                        <input type="hidden" name="order_id" value="<?= htmlspecialchars($orderDetails['order_id']) ?>">
                        <div class="d-flex align-items-center gap-3 form">
                            <select name="status" class="form-select w-auto">
                                <option value="pending" <?= $orderDetails['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                                <option value="confirmed" <?= $orderDetails['status'] === 'confirmed' ? 'selected' : '' ?>>Confirmed</option>
                                <option value="shipped" <?= $orderDetails['status'] === 'shipped' ? 'selected' : '' ?>>Shipped</option>
                            </select>
                            <button type="submit" class="btn btn-primary">Update Status</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php else: ?>
            <!-- Orders List -->
            <?php if (empty($activeOrders)): ?>
                <div class="alert alert-info">No active orders found. Check database status values.</div>
            <?php else: ?>
                <?php foreach ($activeOrders as $order): ?>
                    <div class="order-card mb-3 p-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <h5 class="mb-0 " style="color: #5D4037;">Order #<?= htmlspecialchars($order['order_id']) ?></h5>
                                <small class="text-muted"><?= htmlspecialchars($order['date']) ?></small>
                            </div>
                            <span class="status-badge status-<?= htmlspecialchars($order['status']) ?>">
                                <?= htmlspecialchars($order['status']) ?>
                            </span>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <p class="mb-1"><strong>Customer:</strong> <?= htmlspecialchars($order['name'] ?? 'N/A') ?></p>
                                <p class="mb-1"><strong>Room:</strong> <?= htmlspecialchars($order['room'] ?? 'N/A') ?></p>
                            </div>
                            <div class="col-md-4">
                                <p class="mb-1"><strong>Total:</strong> <?= number_format($order['total_price'], 2) ?> EGP</p>
                            </div>
                            <div class="col-md-4 text-end">
                                <a href="?order_id=<?= htmlspecialchars($order['order_id']) ?>" class="btn btn-outline-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
</body>

</html>