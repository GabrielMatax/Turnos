<!DOCTYPE html>
<html>
<head>
    <title>Editar medico</title>
</head>
<body>
    <a href="FormularioMedicos.php">ATRAS</a>
<?php
include 'Medicos.php';
include 'Conexion.php';

$medico = new Medico($conn);
$medicoInfo = array();
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $medicoId = $_POST["id"];
    $nombre = $_POST["apellido_nombre"];
    $domicilio = $_POST["domicilio"];
    $dni = $_POST["dni"];
    $disponibilidad = $_POST["disponibilidad"];
    $especialidad = $_POST["especialidad"];

    if ($medico->actualizarMedico($medicoId, $nombre, $domicilio, $especialidad, $disponibilidad, $dni)) {
        echo "Actualizado exitosamente.";
    } else {
        echo "Error al actualizar.";
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $medicoId = $_GET["id"];
    $medicoInfo = $medico->obtenermedicoPorId($medicoId);
    if (!$medicoInfo) {
        die("no encontrado.");
    }
}
?>

    <h1>Editar Medico</h1>
    <?php
    $volver="./FormularioMedicos.php";
    if (!empty($message)) {
        echo "<p>$message</p>";
    } elseif (!empty($medicoInfo)) {
    ?>

    <form action="EditarMedicos.php" method="post">
        <input type="hidden" name="id" value="<?php echo $medicoInfo["id"]; ?>">
        <label>Nombre:</label>
        <input type="text" name="apellido_nombre" value="<?php echo $medicoInfo["apellido_nombre"]; ?>"><br>
        <label>Especialidad:</label>
        <input type="text" name="especialidad" value="<?php echo $medicoInfo["especialidad"]; ?>"><br>
        <label>Disponibilidad:</label>
        <input type="text" name="disponibilidad" value="<?php echo $medicoInfo["disponibilidad"]; ?>"><br>
        <label>Domicilio:</label>
        <input type="text" name="domicilio" value="<?php echo $medicoInfo["domicilio"]; ?>"><br>
        <label>DNI:</label>
        <input type="text" name="dni" value="<?php echo $medicoInfo["dni"]; ?>"><br>
        <input type="submit" value="Guardar Cambios">
    </form>

    <?php
    
    } else {
       echo "<a href=".$volver.">Listado</a>";
    }

    $conn->close();
    ?>
</body>
</html>