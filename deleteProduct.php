<?php
    $connection = new pdo("mysql:host=localhost;dbname=cafeteriaa", "root", "01158353178");
        try{
            $productId = $_POST['productId'];
            $stmt = $connection->prepare("delete from products where id = ?");
            $stmt->execute([$productId]);
            header("Location: ViewProducts.php");
        } catch(PDOException $e){
            echo "<div class='alert alert-danger' role='alert'> A simple danger alert—check it out!</div>";
        }

?>