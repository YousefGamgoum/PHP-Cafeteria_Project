
<?php


include 'Connection.php';

if (isset($_GET['order_id'])) {
    $order_id = (int)$_GET['order_id'];

    $sql = "SELECT Amount, unit_price, total_price FROM orders WHERE order_id = ?";
    $stmt = $connection->prepare($sql);
    if ($stmt->execute([$order_id])) {
        $order = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($order) {
            echo "<h3>Order Details</h3>";
            echo "<p><strong>Amount:</strong> {$order['Amount']} </p>";
            echo "<p><strong>Unit Price:</strong> {$order['unit_price']} EGP</p>";
            echo "<p><strong>Total Price:</strong> {$order['total_price']} EGP</p>";
        } else {
            echo "<p>No details found for this order.</p>";
        }
    } else {
        echo "<p style='color:red;'>Database query failed.</p>";
    }
} else {
    echo "<p style='color:red;'>No order_id received.</p>";
}
?>
