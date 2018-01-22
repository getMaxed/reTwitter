<?php

require 'config.php';

try {
    $pdo = new PDO(DSN, USER, PASSWORD);
} catch (PDOException $e) {
    echo 'Connection error! ' . $e->getMessage();
}

