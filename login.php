<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db.php';

$conn = db_connection();
$conn->set_charset("utf8");

if ($conn->connect_error) {
    die("Database connected: " . $conn->connect_error);
}
echo "Connection ok!";

// Võtame vormist andmed
$email = $_POST['email'];
$password = $_POST['password'];

// Valmistame ette päringu andmebaasi
$sql = "SELECT * FROM login WHERE email='$email' AND password='$password'";
$result = $conn->query($sql);

// Kontrollime, kas kasutaja eksisteerib andmebaasis
if ($result->num_rows > 0) {
    // Kasutaja on õige, suuname ta tervituslehele
    header("Location: products.php");
    exit(); // Oluline on lõpetada skripti töö, et vältida edasist töötlemist pärast suunamist
} else {
    // Kasutaja andmeid ei leitud andmebaasist, suuname tagasi logimislehele koos veateatega
    header("Location: register.php");
    $conn->close();

}

