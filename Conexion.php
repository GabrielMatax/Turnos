<?php 
$servername = "localhost";
$username = "root";
$password = "";
$database = "gestion_clinica";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

   /* function agregar($nombres, $apellido){
        // Check the connection.
        $nombcompl= $nombres .  ' ' . $apellido;
        $conn = mysqli_connect("localhost", "root", "", "gestion_clinica");
        if ($conn === false) {
            die("Error connecting to MySQL: " . mysqli_connect_error());
        }
        $sql = "INSERT INTO medicos(apellido_nombre) VALUES ('$nombcompl')";
        $result = mysqli_query($conn, $sql);
        if ($result === false) {
            die("Error inserting data into MySQL: " . mysqli_error($conn));
        }
        mysqli_close($conn);
    }
    */
?>