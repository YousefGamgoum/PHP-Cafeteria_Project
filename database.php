<?php
$host = 'localhost';
$dbname = 'databaseProject';
$username = 'root';
$password = 'Root@123';

$connection = new mysqli($host, $username, $password, $dbname);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
} 
?>
