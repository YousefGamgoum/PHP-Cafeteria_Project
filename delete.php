<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {

        $connection = new PDO("mysql:host=localhost;dbname=php project", "root", "Root@123");
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stm = $connection->prepare("DELETE FROM users WHERE id = ?");
        $stm->execute([$id]);


        header("Location: list.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
