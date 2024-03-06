<?php
$admin_mail = "";
$smtpUsername = "";
$smtpPassword = "";
/* SendGrid */      
$password_sendgrid = "";    
$username_sendgrid = "apikey";
/* Mailtrap */
$username_mailtrap = '';
$password_mailtrap = '';
/* Database local */
$db_username_local = 'marek';
$db_password_local = '123456';
$db_server_local = "127.0.0.1";
$site_local = "http://localhost";
/* Database azure */
if (strpos($_SERVER['HTTP_HOST'],"azurewebsites") !== false){
  $db_username_remote = "manniksaarma";
  $db_password_remote = "19696";
/* Database server port number */
  $db_server_remote = "localhost:8081";
/* Site remote: ownwebapp.azurewebsites.net */  
  $site_remote = 'https://manniksaarma.azurewebsites.net';
  }