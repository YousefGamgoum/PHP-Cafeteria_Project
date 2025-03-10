<?php
$connection = new pdo("mysql:host=localhost;dbname=php project","root","Root@123");
$CategoryName = $_POST['CategoryName'];
try{
    if(strlen($CategoryName)>0){
        $stm = $connection->prepare("insert into categories (name) values(?)");
        $stm->execute([$CategoryName]);
    }
    header("Location:AddProduct.php");
} catch(PDOException $e){
    echo "<div class='alert alert-danger' role='alert'> A simple danger alert—check it out!</div>";
}   


?>