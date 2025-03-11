<?php
$dbType = 'mysql';
$dbHost = 'localhost';
$dbName = 'php project';
$userName = 'root';
$password = 'Root@123';

$connection=new PDO("$dbType:host=$dbHost;dbname=$dbName",$userName,$password);
 $result = "select * from orders ORDER BY created_at DESC";
 $sqlQuery=$connection->prepare($result);
 $sqlQuery->execute();
 $orders=$sqlQuery->fetchAll(PDO::FETCH_ASSOC);

