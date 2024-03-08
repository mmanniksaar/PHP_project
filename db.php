<?php

function db_connection() {
    if (strpos($_SERVER['HTTP_HOST'], 'azurewebsites.net') !== false) {
        $db_host = $_ENV['MYSQL_HOSTNAME'] ?? getenv('MYSQL_HOSTNAME');
        $db_username = $_ENV['MYSQL_USERNAME'] ?? getenv('MYSQL_USERNAME');
        $db_password = $_ENV['MYSQL_PASSWORD'] ?? getenv('MYSQL_PASSWORD');
        $db_name = $_ENV['MYSQL_DB_NAME'] ?? getenv('MYSQL_DB_NAME');
    } else {
        $db_host = "localhost";
        $db_username = "marek";
        $db_password = "123456";
        $db_name = "shop";
    }

    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

