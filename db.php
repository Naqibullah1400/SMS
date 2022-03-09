<?php

$servername = "localhost";
$username = "root";
$password = null;

try {
    $conn = new PDO("mysql:host=$servername; dbname=maktab", $username, $password);
} catch (PDOException $e) {
    echo $e->getMessage();
}
