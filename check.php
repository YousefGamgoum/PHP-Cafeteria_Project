<?php
session_start();


// دالة لإنشاء الاتصال بقاعدة البيانات
function getConnection()
{
    $DBName = "php project";  // اسم قاعدة البيانات
    $host = "localhost";     // السيرفر
    $DBtype = "mysql";       // نوع قاعدة البيانات
    $userName = "root";      // اسم المستخدم
    $userPassword = "Root@123";  // كلمة المرور

    try {
        // محاولة إنشاء الاتصال بقاعدة البيانات باستخدام PDO
        $connection = new PDO("$DBtype:host=$host;dbname=$DBName", $userName, $userPassword);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // تفعيل معالجة الأخطاء
        return $connection;
    } catch (PDOException $e) {
        // في حال حدوث خطأ في الاتصال، سيتم عرض رسالة الخطأ
        echo "Connection failed: " . $e->getMessage();
    }
}

// دالة للحصول على جميع المستخدمين
function getAllUsers()
{
    $connection = getConnection();
    $sql = "SELECT id, username FROM users";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// دالة للحصول على الفواتير باستخدام الفلاتر
function getFilteredChecks($filters = [])
{
    $connection = getConnection();

    $sql = "SELECT u.id as user_id, u.username, u.email, 
                   COUNT(o.order_id) as order_count, 
                   SUM(o.total_price) as total_amount
            FROM users u
            LEFT JOIN orders o ON u.id = o.user_id";

    $where_conditions = [];
    $params = [];

    // إضافة فلتر التاريخ
    if (!empty($filters['date_from'])) {
        $where_conditions[] = "o.created_at >= :date_from";
        $params[':date_from'] = $filters['date_from'] . ' 00:00:00';
    }

    if (!empty($filters['date_to'])) {
        $where_conditions[] = "o.created_at <= :date_to";
        $params[':date_to'] = $filters['date_to'] . ' 23:59:59';
    }

    // إضافة فلتر المستخدم
    if (!empty($filters['user_id'])) {
        $where_conditions[] = "u.id = :user_id";
        $params[':user_id'] = $filters['user_id'];
    }

    // دمج الشروط في الاستعلام إذا وجدت
    if (!empty($where_conditions)) {
        $sql .= " WHERE " . implode(" AND ", $where_conditions);
    }

    $sql .= " GROUP BY u.id, u.username, u.email ORDER BY total_amount DESC"; // تأكد من أن GROUP BY في مكانه الصحيح

    $stmt = $connection->prepare($sql);

    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// دالة للحصول على طلبات المستخدم
function getUserOrders($userId, $dateFrom = null, $dateTo = null)
{
    $connection = getConnection();

    $sql = "SELECT o.order_id, o.created_at as date, o.total_price, o.status, r.room_number as room_name
            FROM orders o
            LEFT JOIN rooms r ON o.room_id = r.room_number  -- تعديل هنا
            WHERE o.user_id = :user_id";

    $params = [':user_id' => $userId];

    if ($dateFrom) {
        $sql .= " AND o.created_at >= :date_from";
        $params[':date_from'] = $dateFrom . ' 00:00:00';
    }

    if ($dateTo) {
        $sql .= " AND o.created_at <= :date_to";
        $params[':date_to'] = $dateTo . ' 23:59:59';
    }

    $sql .= " ORDER BY o.created_at DESC";

    $stmt = $connection->prepare($sql);

    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// دالة للحصول على تفاصيل المستخدم
function getUserDetails($userId)
{
    $connection = getConnection();
    $sql = "SELECT id, username, email FROM users WHERE id = :user_id";

    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}
// الطباعة لتتبع الفلاتر والبيانات المسترجعة:



// دالة للحصول على تفاصيل الطلب
// function getOrderDetails($orderId)
// {
//     $connection = getConnection();
//     $sql = "SELECT  o.created_at, o.total_price, o.status
//             u.username as user
//             FROM orders o
//             JOIN users u ON o.user_id = u.id
//             LEFT JOIN rooms r ON o.room_id = r.id
//             WHERE o.id = :order_id";

//     $stmt = $connection->prepare($sql);
//     $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
//     $stmt->execute();

//     return $stmt->fetch(PDO::FETCH_ASSOC);
// }

function getOrderDetails($orderId) {
    $connection = getConnection();
    $sql = "SELECT o.order_id, o.created_at, o.total_price, o.status, r.room_number as room_name, 
            u.username as user
            FROM orders o
            JOIN users u ON o.user_id = u.id
            LEFT JOIN rooms r ON o.room_id = r.id
            WHERE o.order_id = :order_id";
    
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
    $stmt->execute();
    
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// تهيئة متغيرات الفلاتر
$filters = [
    'date_from' => isset($_GET['date_from']) ? $_GET['date_from'] : '',
    'date_to' => isset($_GET['date_to']) ? $_GET['date_to'] : '',
    'user_id' => isset($_GET['user_id']) ? $_GET['user_id'] : ''
];

// المستخدم المحدد لعرض التفاصيل
$selectedUserId = isset($_GET['view_user']) ? $_GET['view_user'] : null;

// الطلب المحدد لعرض التفاصيل
$selectedOrderId = isset($_GET['view_order']) ? $_GET['view_order'] : null;

// الحصول على بيانات الفلاتر
$users = getAllUsers();

// الحصول على البيانات المفلترة
$filteredChecks = getFilteredChecks($filters);

$userOrders = [];
$userDetails = null;
if ($selectedUserId) {
    $userOrders = getUserOrders($selectedUserId, $filters['date_from'], $filters['date_to']);
    $userDetails = getUserDetails($selectedUserId);
}

// الحصول على تفاصيل الطلب إذا تم تحديد طلب
// دالة للحصول على عناصر الطلب
// function getOrderItems($orderId)
// {
//     $connection = getConnection();
//     $sql = "SELECT oi.item_name, oi.quantity, oi.price
//             FROM order_items oi
//             WHERE oi.order_id = :order_id";

//     $stmt = $connection->prepare($sql);
//     $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
//     $stmt->execute();

//     return $stmt->fetchAll(PDO::FETCH_ASSOC);
// }

function getOrderItems($orderId) {
    $connection = getConnection();
    $sql = "SELECT p.name, p.price, oi.quantity, p.image, 
            (p.price * oi.quantity) as item_total
            FROM order_items oi
            JOIN products p ON oi.product_id = p.id
            WHERE oi.order_id = :orderId";
    
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':orderId', $orderId, PDO::PARAM_INT);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$orderDetails = null;
$orderItems = [];
if ($selectedOrderId) {
    $orderDetails = getOrderDetails($selectedOrderId);
    $orderItems = getOrderItems($selectedOrderId);
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Admin Checks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
    body {
        background: linear-gradient(to right, #4E342E, #8D6E63);
    }

    .filter-card {
        background-color: #FFF8E1;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        z-index: 999;
    }

    .table,
    .modal-content,
    .summary {
        background-color: #FFF8E1;
    }

    nav {
        background-color: #3b2f23 !important;
        z-index: 9999;
    }

    nav a {
        color: white !important;
    }

    nav a:hover {
        color: #d2ab86 !important;
    }

    .con {
        margin-top: 50px;
    }
    body{
        background: linear-gradient(to right, #4E342E, #8D6E63);
    }
    </style>
</head>

<body>
<nav class="navbar navbar-expand-lg" >
        <div class="container">
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
    <div class="container pt-5 pb-5 mt-5">
        <h2 class="text-warning text-center "><i class="fas fa-receipt"></i> Checks</h2>

        <!-- Filter Form -->
        <div class="filter-card">
            <form method="GET" action="" id="filter-form">
                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label">Date Range</label>
                        <div class="input-group">
                            <input type="date" name="date_from" class="form-control"
                                value="<?php echo $filters['date_from']; ?>" placeholder="From">
                            <span class="input-group-text">to</span>
                            <input type="date" name="date_to" class="form-control"
                                value="<?php echo $filters['date_to']; ?>" placeholder="To">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">User</label>
                        <select name="user_id" class="form-select">
                            <option value="">All Users</option>
                            <?php foreach ($users as $user): ?>
                            <option value="<?php echo $user['id']; ?> "
                                <?php echo ($filters['user_id'] == $user['id']) ? 'selected' : ''; ?>>
                                <?php echo $user['username']; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="filter-buttons pt-3">
                    <button type="button" class="btn btn-danger fw-bold" style='background-color: #6D4C41'
                        onclick="resetFilters()">
                        <i class='fas fa-undo ' style='color: white '></i> Reset Filters
                    </button>

                    <button type="submit" class="btn text-white fw-bold" style='background-color: #6D4C41'>
                        <i class='fas fa-filter' style='color: white; font-size: 20px;'></i> Apply Filters
                    </button>
                </div>

                <!-- If viewing user details, keep the view_user parameter -->
                <?php if ($selectedUserId): ?>
                <input type="hidden" name="view_user" value="<?php echo $selectedUserId; ?>">
                <?php endif; ?>

                <!-- If viewing order details, keep the view_order parameter -->
                <?php if ($selectedOrderId): ?>
                <input type="hidden" name="view_order" value="<?php echo $selectedOrderId; ?>">
                <?php endif; ?>
            </form>
        </div>

        <!-- User Checks Summary -->
        <div class="card summary">
            <div class="card-header">
                <h5>User Summary</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Email</th>
                                <th class="text-center">Orders</th>
                                <th class="text-end">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($filteredChecks)): ?>
                            <tr>
                                <td colspan="4" class="text-center py-3">No data found for the selected filters</td>
                            </tr>
                            <?php else: ?>
                            <?php foreach ($filteredChecks as $check): ?>
                            <tr class="check-row <?php echo ($selectedUserId == $check['user_id']) ? 'active' : ''; ?>"
                                onclick="viewUserOrders(<?php echo $check['user_id']; ?>)">
                                <td><?php echo $check['username']; ?></td>
                                <td><?php echo $check['email']; ?></td>
                                <td class="text-center"><?php echo $check['order_count']; ?></td>
                                <td class="text-end"><?php echo $check['total_amount']; ?></td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- User Orders Table (if user is selected) -->
        <?php if ($selectedUserId): ?>
        <div class="card mt-3">
            <div class="card-header">
                <h5>Orders for <?php echo $userDetails['username']; ?></h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th>Room</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($userOrders)): ?>
                            <tr>
                                <td colspan="4" class="text-center py-3">No orders found for this user</td>
                            </tr>
                            <?php else: ?>
                            <?php foreach ($userOrders as $order): ?>
                            <tr class="order-row" onclick="viewOrderDetails(<?php echo $order['order_id']; ?>)">

                                <td><?php echo $order['date']; ?></td>
                                <td><?php echo $order['total_price']; ?></td>
                                <td><?php echo $order['status']; ?></td>
                                <td><?php echo $order['room_name']; ?></td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <script>
    function viewUserOrders(userId) {
        // إذا تم النقر على اسم المستخدم، سيتم تحديث العرض
        window.location.href = '?view_user=' + userId;
    }

    function viewOrderDetails(orderId) {
        // إذا تم النقر على الطلب، سيتم عرض تفاصيله
        window.location.href = '?view_order=' + orderId;
    }

    function resetFilters() {
        // إعادة تعيين الفلاتر
        document.getElementById('filter-form').reset();
        window.location.href = 'check.php';
    }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
</body>

</html>