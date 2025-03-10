<?php
session_start();
include 'Connection.php';



if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];


$sql = "SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC";
$stmt = $connection->prepare($sql);
$stmt->execute([$user_id]);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <title>My Orders</title>
    <link rel="stylesheet" href="aa.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
   

    <h2 id="title-page">My Orders</h2>

    <form id="filterForm"  class="filter_data">
        <label>From: <input type="date" id="start_date" name="start_date"></label>
        <label>To: <input type="date" id="end_date" name="end_date"></label>
        <button type="submit">Filter</button>
    </form>

    <section class="container">
        <table>
            <thead>
                <tr>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Amount</th>
                    <th>Price</th>
                    <th>Total Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="orders_table">
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td class="order-details" data-order-id="<?= $order['order_id'] ?>" style="cursor: pointer;">
                            <?= $order['created_at'] ?>
                        </td>
                        <td><?= $order['status'] ?></td>
                        <td>
                            <form method="POST" action="Amount.php">
                                <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
                                <button type="submit" name="change_amount" value="-1">-</button>
                                <?= (int)$order['Amount'] ?>
                                <button type="submit" name="change_amount" value="1">+</button>
                            </form>
                        </td>
                        <td><?= $order['unit_price'] ?></td>
                        <td><?= $order['total_price'] ?></td>
                        <td>
                            <?php if ($order['status'] == 'pending'): ?>
                                <form method="POST" action="cancel_order.php">
                                    <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
                                    <button type="submit">Cancel</button>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

    <script src="./main.js?v=<?php echo time(); ?>"></script>
</body>

</html>