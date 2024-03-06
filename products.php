<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="login.css">

</head>

<?php
/* include 'db.php';
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Loome ühenduse andmebaasiga
$servername = "datasql4.westeurope.cloudapp.azure.com:8081";
$username = "manniksaarma"; // Asenda oma andmebaasi kasutajanimega
$password = "19696"; // Asenda oma andmebaasi parooliga
$dbname = "shop"; // Asenda oma andmebaasi nimega

// Loome ühenduse andmebaasiga
/* $servername = "localhost";
$username = "marek"; // Asenda oma andmebaasi kasutajanimega
$password = "123456"; // Asenda oma andmebaasi parooliga
$dbname = "shop"; // Asenda oma andmebaasi nimega
 */

$conn = new mysqli($servername, $username, $password, $dbname);

// Kontrollime ühendust
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Teostame päringu, et saada toodete andmed
$sql = "SELECT * FROM albums";
$result = $conn->query($sql);

// Kuvame tooted, kui päring oli edukas
if ($result->num_rows > 0) {
    // Itereerime läbi iga toote andmed
    while($row = $result->fetch_assoc()) {
        // Kuvame toote HTML-is
        echo '<div class="container py-5">';
        echo '<div class="row justify-content-center mb-3">';
        echo '<div class="col-md-12 col-xl-10">';
        echo '<div class="card shadow-0 border rounded-3">';
        echo '<div class="card-body">';
        echo '<div class="row">';
        echo '<div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">';
        echo '<div class="bg-image hover-zoom ripple rounded ripple-surface">';
        echo '<img src="' . $row["image_link"] . '" class="w-100" />';
        echo '<a href="#!"><div class="hover-overlay">';
        echo '<div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>';
        echo '</div></a></div></div>';
        echo '<div class="col-md-6 col-lg-6 col-xl-6">';
        echo '<h5>' . $row["album_name"] . '</h5>';
        echo '<div class="d-flex flex-row">';
        echo '<div class="text-danger mb-1 me-2">';
        for ($i = 0; $i < $row["rating"]; $i++) {
            echo '<i class="fa fa-star"></i>';
        }
        echo '</div>';
        echo '<span>' . $row["rating"] . '</span>';
        echo '</div>';
        echo '<ol class="list-group list-group-numbered">';
        
         // Teeme päringu albumi laulude saamiseks
         $album_id = $row["id"];
         $songs_query = "SELECT * FROM album_songs WHERE album_id = $album_id";
         $songs_result = $conn->query($songs_query);
         
         if ($songs_result->num_rows > 0) {
             echo '<ol class="list-group list-group-numbered">';
             // Kuvame iga laulu albumi jaoks
             while($song_row = $songs_result->fetch_assoc()) {
                 echo '<li >' .$song_row["song"] . '</li>';
             }
             echo '</ol>';
         } else {
             echo '<p>No songs found for this album</p>';
         }
         
        echo '</div>';


        echo '<div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">';
        echo '<div class="d-flex flex-row align-items-center mb-1">';
        echo '<h4 class="mb-1 me-1">$' . $row["price"] . '</h4>';
        if ($row["discount"] != "") {
            echo '<span class="text-danger"><s>$' . $row["discount"] . '</s></span>';
        }
        echo '</div>';
        echo '<h6 class="text-success">' . $row["shipping"] . '</h6>';
        echo '<div class="d-flex flex-column mt-4">';
        echo '<button class="btn btn-outline-primary btn-sm mt-2" type="button">Add to Cart</button>';
        echo '</div></div></div></div></div></div></div></div>';
    }
} else {
    echo "No products found";
}

// Sulgeme ühenduse
$conn->close();
?>
