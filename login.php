<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Ühenduse loomine andmebaasiga (asendage need teie andmetega)
$servername = "localhost";
$username = "marek";
$password = "123456";
$dbname = "shop";

$conn = new mysqli($servername, $username, $password, $dbname);



// Kontrollime ühendust
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Võtame vormist andmed
$email = $_POST['email'];
$password = $_POST['password'];

// Valmistame ette päringu andmebaasi
$sql = "SELECT * FROM login WHERE email='$email' AND password='$password'";
$result = $conn->query($sql);

// Kontrollime, kas kasutaja eksisteerib andmebaasis
if ($result->num_rows > 0) {
    // Kasutaja on õige, suuname ta tervituslehele
    header("Location: product.php");
    exit(); // Oluline on lõpetada skripti töö, et vältida edasist töötlemist pärast suunamist
} else {
    // Kasutaja andmeid ei leitud andmebaasist, suuname tagasi logimislehele koos veateatega
    header("Location: login.html?error=invalid_credentials");
    $conn->close();

}


