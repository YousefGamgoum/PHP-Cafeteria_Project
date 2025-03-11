<?php
session_start();
require_once "database.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION["user_id"])) {
        die("User not logged in.");
    }

    include('databaseconnection.php');
    $user_id = $_SESSION["user_id"];
    $TempUser = $user_id;
    // Read JSON input
    $data = json_decode(file_get_contents("php://input"), true);
    
    if (isset($data['cart'])) {
        $_SESSION['cart'] = json_decode($data['cart'], true); // Decode JSON and store in session
        echo json_encode(["status" => "success", "message" => "Cart saved in session"]);
    } else {
        echo json_encode(["status" => "error", "message" => "No data received"]);
    }
    if (isset($_POST['UserId'])) {
        $user_id = $_POST["UserId"];
    }
    
    
    $room_id = $_POST["Room"] ?? null;
    $cart = $_SESSION["cart"] ?? [];

    if (!$room_id || empty($cart)) {
        $user_id = $TempUser;
        die("Invalid order data.");
    }

    try {
        $connection->beginTransaction();

        // Calculate total price and total amount
        $total_price = 0;
        $total_quantity =0;

        foreach ($cart as $item) {
            $total_price += $item["price"] * $item["quantity"];
            $total_quantity += $item["quantity"];
        }

        // Insert into orders table (including Amount and unit_price)
        $stmt = $connection->prepare("INSERT INTO orders (user_id, room_id,  total_price, Amount, unit_price, status, created_at) VALUES (?, ?, ?, ?, ?, 'pending', NOW())");
        $stmt->execute([$user_id, $room_id, $total_price,$total_quantity,  ($total_price / $total_quantity)]);

        // Get the last inserted order ID
        $order_id = $connection->lastInsertId();

        // Insert items into order_items table
        $stmt = $connection->prepare("INSERT INTO order_items (order_id, product_id, quantity, unit_price) VALUES (?, ?, ?, ?)");
        foreach ($cart as $item) {
            $stmt->execute([$order_id, $item["ID"], $item["quantity"], $item["price"]]);
        }

        $connection->commit();
        $_SESSION["cart"] = []; // Clear cart after order is placed
        $user_id = $TempUser;
        if (isset($_POST['UserId'])) {
            header("Location: admin.php?order_success=1");
        } else {
            header("Location: home.php?order_success=1");
        }
         // Redirect to home page with success message

        exit();
    } catch (PDOException $e) {
        $user_id = $TempUser;
        $connection->rollBack();
        die("Order failed: " . $e->getMessage());
    }
} else {
    die("Invalid request.");
}
?>
