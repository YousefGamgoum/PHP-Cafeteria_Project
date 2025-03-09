<?php
session_start();
require_once "database.php"; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION["user_id"])) {
        die("User not logged in.");
    }

    $user_id = $_SESSION["user_id"];
    $room_id = $_POST["Room"] ?? null;
    $cart = $_SESSION["cart"] ?? [];

    if (!$room_id || empty($cart)) {
        die("Invalid order data.");
    }

    try {
        $connection->beginTransaction();

        // Calculate total price
        $total_price = 0;
        foreach ($cart as $item) {
            $total_price += $item["unit_price"] * $item["quantity"];
        }

        // Insert into orders table
        $stmt = $connection->prepare("INSERT INTO orders (user_id, room_id, total_price, status, created_at) VALUES (?, ?, ?, 'pending', NOW())");
        $stmt->execute([$user_id, $room_id, $total_price]);

        // Get the last inserted order ID
        $order_id = $connection->lastInsertId();

        // Insert items into order_items table
        $stmt = $connection->prepare("INSERT INTO order_items (order_id, product_id, quantity, unit_price) VALUES (?, ?, ?, ?)");
        foreach ($cart as $item) {
            $stmt->execute([$order_id, $item["product_id"], $item["quantity"], $item["unit_price"]]);
        }

        $connection->commit();
        $_SESSION["cart"] = []; // Clear cart after order is placed

        header("Location: home.php?order_success=1"); // Redirect to home page with success message
        exit();
    } catch (PDOException $e) {
        $connection->rollBack();
        die("Order failed: " . $e->getMessage());
    }
} else {
    die("Invalid request.");
}
?>
