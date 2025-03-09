<?php
    $connection = new pdo("mysql:host=localhost;dbname=cafeteriaa","root","01158353178");
        try{
            $productId = $_POST['productId'];
            $productName = $_POST['productName'];
            $productPrice = $_POST['productPrice'];
            $productCategory = $_POST['productCategory'];
            $productImage = $_POST['productImage'];
            $connection->query("update products set name = '$productName', price = '$productPrice', image = '$productImage', category_id = '$productCategory' where id = '$productId'");
            header("Location: ViewProducts.php");
        } catch(PDOException $e){
            // echo "<div class='alert alert-danger' role='alert'> A simple danger alert—check it out!</div>";
            echo $e->getMessage();
        } 

?>