<?php
include 'Connection.php';

if(isset($_POST['order_id']) && isset($_POST['change_amount'])){
    $order_id = (int)$_POST['order_id'];
    $change = (int)$_POST['change_amount'];

    $sql = "SELECT Amount, unit_price FROM orders WHERE order_id = $order_id";
    $sqlQuery = $connection->prepare($sql);
    $sqlQuery->execute();
    $row = $sqlQuery->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $new_amount = $row['Amount'] + $change;

      
        if ($new_amount > 0) {
            $unit_price = $row['unit_price'];
            $total_price = $new_amount * $unit_price;
           
            $update_sql = "UPDATE orders SET Amount = $new_amount, total_price = $total_price WHERE order_id = $order_id";
            $update_sqlQuery = $connection->prepare($update_sql);
            $update_sqlQuery->execute();
        }else{
            $delete_sql = "DELETE FROM orders WHERE order_id = $order_id";
            $delete_sqlQuery = $connection->prepare($delete_sql);
            $delete_sqlQuery->execute();
        }
    }

    header("Location: myorder.php"); 
    exit();
}
?>


