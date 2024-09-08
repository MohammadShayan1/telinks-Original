<?php
// $servername = "localhost";
// $username = "mshayan_telinksimg_db";
// $password = "Q^G05I9i}H_W";
// $db = "mshayan_telinksimg_db";
$servername = "localhost";
$username = "root";
$password = "";
$db = "telinks";
$conn = new mysqli($servername, $username, $password, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>