<!DOCTYPE html>
<html>
<head>
    <title>Gestión de Pacientes</title>
</head>
<body>

    <a href="index.php">Home</a>
    <h1>Gestión de Pacientes</h1>
    
    <?php
    include 'Pacientes.php';
    include 'Conexion.php';

    $paciente = new Paciente($conn);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
    //MENSAJES
    //CREAR
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($_POST["action"] === "create") {
            $nombre = $_POST["nombre"];
            $apellido = $_POST["apellido"];
            $domicilio = $_POST["domicilio"];
            $dni = $_POST["dni"];
            $telefono = $_POST["telefono"];

            if ($paciente->crearPaciente($nombre, $apellido, $domicilio, $dni, $telefono)) {
                echo "Paciente creado exitosamente.";
            } else {
                echo "Error al crear paciente.";
            }
        }
    }
    //ELIMINAR
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
        $pacienteId = $_GET["id"];
    
        if ($paciente->eliminarPaciente($pacienteId)) {
            echo "Paciente eliminado exitosamente.";
        } else {
            echo "Error al eliminar paciente.";
        }
    }

    $pacientes = $paciente->obtenerPacientes();
    ?>

    <h2>Crear Nuevo Paciente</h2>
    <form action="FormularioPacientes.php" method="post">
        <input type="hidden" name="action" value="create">
        <label>Nombre:</label>
        <input type="text" name="nombre"><br>
        <label>Apellido:</label>
        <input type="text" name="apellido"><br>
        <label>Domicilio:</label>
        <input type="text" name="domicilio"><br>
        <label>DNI:</label>
        <input type="text" name="dni"><br>
        <label>Teléfono:</label>
        <input type="text" name="telefono"><br>
        <input type="submit" value="Crear Paciente">
    </form>

    <h2>Listado de Pacientes</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Domicilio</th>
            <th>DNI</th>
            <th>Teléfono</th>
            <th>Acciones</th>
        </tr>
        <?php
        foreach ($pacientes as $pac) {
            echo "<tr>";
            echo "<td>" . $pac["id"] . "</td>";
            echo "<td>" . $pac["nombre"] . "</td>";
            echo "<td>" . $pac["apellido"] . "</td>";
            echo "<td>" . $pac["domicilio"] . "</td>";
            echo "<td>" . $pac["dni"] . "</td>";
            echo "<td>" . $pac["telefono"] . "</td>";
            echo "<td><a href='EditarPacientes.php?id=" . $pac["id"] . "'>Editar</a> | <a href='FormularioPacientes.php?id=" . $pac["id"] . "'>Eliminar</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
    <?php
 //   $conn->close();
    ?>
</body>
</html>