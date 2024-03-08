<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db.php';

$conn = db_connection();
$conn->set_charset("utf8");

if ($conn->connect_error) {
    die("Database connected: " . $conn->connect_error);
}


$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM login WHERE email='$email' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    header("Location: products.php");
    exit(); 
} else {
    header("Location: register.html");
    $conn->close();

}


