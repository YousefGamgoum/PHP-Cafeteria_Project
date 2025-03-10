<?php
    $connection = new pdo("mysql:host=localhost;dbname=php project","root","Root@123");
        try{
            $productId = $_POST['productId'];
            $productName = $_POST['productName'];
            $productPrice = $_POST['productPrice'];
            $productCategory = $_POST['productCategory'];
            $productImage = $_POST['Image'];
            $productImg = uniqid() . "_" . basename($_FILES['Image']['name']);
            move_uploaded_file($_FILES['Image']['tmp_name'], "img/" . $productImg);

            $connection->query("update products set name = '$productName', price = '$productPrice', image = '$productImg', category_id = '$productCategory' where id = '$productId'");
            header("Location: ViewProducts.php");
        } catch(PDOException $e){
            // echo "<div class='alert alert-danger' role='alert'> A simple danger alert—check it out!</div>";
            echo $e->getMessage();
        } 

?>