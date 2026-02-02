<?php
$servername = "localhost";
$name = "root";
$password = "";
$database = "typing";

$conn = mysqli_connect($servername, $name, $password, $database);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
