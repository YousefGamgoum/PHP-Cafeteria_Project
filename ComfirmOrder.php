<?php


        $connection = new pdo("mysql:host=localhost;dbname=databaseProject", "root", "Root@123");
        $productName = $_POST['productName'];
        $productPrice = $_POST['productPrice'];
        $productCategory = $_POST['productCategory'];
        $productImage = $_POST['productImage'];
        try {
            if(isset($productName)  && isset($productPrice) && isset($productImage) && isset($productCategory)){$stm = $connection->prepare("insert into products (name,price,image,category_id) values(?,?,?,?)");
                $stm->execute([$productName, $productPrice, $productImage, $productCategory]);
                if(isset($_POST['AddSubmit'])){echo "<div class='alert alert-success' role='alert'> A simple danger alert—check it out!</div>";}}
                header("Location:AddProduct.php");
        } catch (PDOException $e) {
            echo "<div class='alert alert-danger' role='alert'> A simple danger alert—check it out!</div>";
        }


?>