<?php

try {
    $db_server   = "mysql:dbname=madiba; host=localhost";
    $user_name   = "root";
    $password    = "";

    $connection = new PDO($db_server, $user_name, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection Error: " . $e->getMessage();
}