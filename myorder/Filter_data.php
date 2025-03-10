<?php
include 'Connection.php';

if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
    $start_date = $_GET['start_date'] . " 00:00:00";
    $end_date = $_GET['end_date'] . " 23:59:59";

    $select_sql = "SELECT * FROM orders WHERE created_at BETWEEN :start_date AND :end_date";
    $select_sqlQuery = $connection->prepare($select_sql);
    $select_sqlQuery->bindParam(':start_date', $start_date);
    $select_sqlQuery->bindParam(':end_date', $end_date);

    if ($select_sqlQuery->execute()) {
        $orders = $select_sqlQuery->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($orders);
        exit();
    } else {
        echo json_encode(["error" => "Database query failed"]);
        exit();
    }
} else {
    echo json_encode(["error" => "Invalid parameters"]);
    exit();
}
