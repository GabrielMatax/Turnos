<!DOCTYPE html>
<html>
<head>
    <title>Editar Paciente</title>
</head>
<body>
    <a href="FormularioPacientes.php">ATRAS</a>
<?php
include 'Pacientes.php';
include 'Conexion.php';

$paciente = new Paciente($conn);
$pacienteInfo = array(); // Inicializa la variable para evitar los errores
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $pacienteId = $_POST["id"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $domicilio = $_POST["domicilio"];
    $dni = $_POST["dni"];
    $telefono = $_POST["telefono"];

    if ($paciente->actualizarPaciente($pacienteId, $nombre, $apellido, $domicilio, $dni, $telefono)) {
        echo "Paciente actualizado exitosamente.";
    } else {
        echo "Error al actualizar paciente.";
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $pacienteId = $_GET["id"];
    $pacienteInfo = $paciente->obtenerPacientePorId($pacienteId);
    if (!$pacienteInfo) {
        die("Paciente no encontrado.");
    }
}
?>

    <h1>Editar Paciente</h1>
    <?php
    $volver="./FormularioPacientes.php";
    if (!empty($message)) {
        echo "<p>$message</p>";
    } elseif (!empty($pacienteInfo)) {
    ?>

    <form action="EditarPacientes.php" method="post">
        <input type="hidden" name="id" value="<?php echo $pacienteInfo["id"]; ?>">
        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $pacienteInfo["nombre"]; ?>"><br>
        <label>Apellido:</label>
        <input type="text" name="apellido" value="<?php echo $pacienteInfo["apellido"]; ?>"><br>
        <label>Domicilio:</label>
        <input type="text" name="domicilio" value="<?php echo $pacienteInfo["domicilio"]; ?>"><br>
        <label>DNI:</label>
        <input type="text" name="dni" value="<?php echo $pacienteInfo["dni"]; ?>"><br>
        <label>Teléfono:</label>
        <input type="text" name="telefono" value="<?php echo $pacienteInfo["telefono"]; ?>"><br>
        <input type="submit" value="Guardar Cambios">
    </form>

    <?php
    
    } else {
       echo "<a href=".$volver.">Home</a>";
    }
    ?>
</body>
</html>