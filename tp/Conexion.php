<?php 
$servername = "localhost";
$username = "root";
$password = "";
$database = "gestion_clinica";

$conn = mysqli_connect($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>