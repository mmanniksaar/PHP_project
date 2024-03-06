<?php
$conn = 'mysql:host=datasql4.westeurope.cloudapp.azure.com:8081; dbname=shop';
$username = 'manniksaarma';
$password = '19696';

$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
try
{
    $conn = new PDO($conn, $username, $password, $options);
}
    catch (PDOException $e)
{
    $error_message = $e->getMessage();
    exit();
}
