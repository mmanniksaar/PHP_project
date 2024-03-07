<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db.php';

$conn = db_connection();
$conn->set_charset("utf8");


// Võtame vormist andmed ja kontrollime, kas väljad on täidetud
if(isset($_POST['firstname'], $_POST['lastname'], $_POST['birthday'], $_POST['gender'], $_POST['email'], $_POST['phonenumber'], $_POST['password'], $_POST['repassword'])) {
    
    // Kui kõik väljad on täidetud, võtame andmed muutujatesse
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $birthday = $_POST['birthday'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    
    if ($password !== $repassword) {
        echo "Passwords do not match"; // Veateade, kui paroolid ei ühti
        exit; // Katkestame skripti töö
    }


    // Valmistame ette ja käivitame päringu, lisades sünnipäeva välja
    $sql = "INSERT INTO login (firstname, lastname, birthday, gender, email, phonenumber, password) VALUES ('$firstname', '$lastname', '$birthday', '$gender', '$email', '$phonenumber', '$password')";

    if ($conn->query($sql) === TRUE) {
        header("Location: products.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    // Kui väljad pole täidetud, siis väljastame vastava teate
    echo "All fields are required";
}

// Sulgeme ühenduse
$conn->close();


