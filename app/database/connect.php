<?php

$host = 'localhost';
$user = "root";
$pass = "root";
$dbName = "blog";

try {
    // $pdo =  new PDO('mysql:host=localhost;dbname=blog', $user, $pass);
    $pdo =  new PDO('mysql:host=' . $host . ';dbname=' . $dbName, $user, $pass);
    // echo "connected";
} catch (PDOException $error) {
    echo $error->getMessage();
}
