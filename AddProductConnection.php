<?php
        $connection = new pdo("mysql:host=localhost;dbname=php project", "root", "Root@123");
        $productName = $_POST['productName'];
        $productPrice = $_POST['productPrice'];
        $productCategory = $_POST['productCategory'];
        $productImage = $_POST['Image'];
        $productImg = uniqid() . "_" . basename($_FILES['Image']['name']);
        move_uploaded_file($_FILES['Image']['tmp_name'], "img/" . $productImg);
        try {
            if(isset($productName)  && isset($productPrice) && isset($productImg) && isset($productCategory)){$stm = $connection->prepare("insert into products (name,price,image,category_id) values(?,?,?,?)");
                $stm->execute([$productName, $productPrice, $productImg, $productCategory]);
                if(isset($_POST['AddSubmit'])){echo "<div class='alert alert-success' role='alert'> A simple danger alert—check it out!</div>";}}
                header("Location:AddProduct.php");
        } catch (PDOException $e) {
            echo "<div class='alert alert-danger' role='alert'> A simple danger alert—check it out!</div>";
        }
       

        
    ?>