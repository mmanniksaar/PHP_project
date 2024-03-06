<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Ühenduse loomine andmebaasiga (asendage need teie andmetega)


$db_server = $_ENV['MYSQL_HOSTNAME'] ?? getenv('MYSQL_HOSTNAME');
$db_username = $_ENV['MYSQL_USERNAME'] ?? getenv('MYSQL_USERNAME');
$db_password = $_ENV['MYSQL_PASSWORD'] ?? getenv('MYSQL_PASSWORD');
$db_name = $ENV['MYSQL_DB_NAME'] ?? getenv('MYSQL_DB_NAME');

// Loome ühenduse andmebaasiga
/* $servername = "localhost";
$username = "marek"; // Asenda oma andmebaasi kasutajanimega
$password = "123456"; // Asenda oma andmebaasi parooliga
$dbname = "shop"; // Asenda oma andmebaasi nimega
 */
$conn = new mysqli($db_server, $db_username, $db_password, $db_name);

/* include 'db.php';
 */
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
    header("Location: products.php");
    exit(); // Oluline on lõpetada skripti töö, et vältida edasist töötlemist pärast suunamist
} else {
    // Kasutaja andmeid ei leitud andmebaasist, suuname tagasi logimislehele koos veateatega
    header("Location: index.php?error=invalid_credentials");
    $conn->close();

}


