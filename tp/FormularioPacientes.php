<!DOCTYPE html>
<html>
<head>
    <title>Gestión de Pacientes</title>
    <link rel="stylesheet" href="./style/formPacientes.css">
    <link rel="stylesheet" href="./style/style.css">
</head>
<body>
<header>
        <div class="banner">
            <img src="./img/logo.png" alt="logo">
            <h1 class="titulo">Clinica Modelo Sinchy</h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a> </li>
                <li><a href="FormularioPacientes.php">Pacientes</a></li>
                <li><a href="FormularioTurnos.php">Turnos</a></li>
                <li><a href="./FormularioMedicos.php">Formulario</a></li>
                <li><a href="#contacto">Contacto</a></li>
            </ul>
        </nav>
    </header>

    <h1 class="titulo">Gestión de Pacientes</h1>
    
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
<footer>
        <h3>Donde nos ubicamos</h3>
        <p>Avenida Cudi 123, Las Bahamas</p>
        <h3>Contactos</h3>
        <p>(408) 555-1234</p>
        <p>clinicaSinchy@Yahoo.com</p>
        <div id="contacto"></div>
    </footer>
</html>