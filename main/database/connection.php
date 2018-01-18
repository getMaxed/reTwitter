<?php
$dsn = 'mysql:host=localhost;dbname=retwitter';
$user = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Connection error! ' . $e->getMessage();
}

