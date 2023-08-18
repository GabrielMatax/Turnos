<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
</head>
<body>
    <header>
        <h1>FORMULARIO</h1>
        <a href="index.php">Home</a>
    </header>
    <section>   
    <?php 
    include 'Conexion.php';
    include 'Medicos.php';
    include 'Especialidades.php'; 
    $medico = new Medico($conn);
    $especialidad = new Especialidad($conn);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $apellidoNombre = $_POST["apellido_nombre"];
        $domicilio = $_POST["domicilio"];
        $especialidadId = $_POST["especialidad_id"];
        $disponibilidad = $_POST["disponibilidad"];
        $dni = $_POST["dni"];

        if ($medico->crearMedico($apellidoNombre, $domicilio, $especialidadId, $disponibilidad, $dni)) {
            echo "Medico creado exitosamente.";
        } else {
            echo "Error al crear paciente.";
        }
    }

    //ELIMINAR
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
        $medicoId = $_GET["id"];
    
        if ($medico->eliminarMedico($medicoId)) {
            echo "Medico eliminado exitosamente.";
        } else {
            echo "Error al eliminar paciente.";
        }
    }

    $medicos = $medico->obtenerMedicos();
    ?>
    <h1>Gestión de Médicos</h1>
    
    <form action="FormularioMedicos.php" method="post">
        <label>Apellido y Nombre:</label>
        <input type="text" name="apellido_nombre"><br>
        
        <label>Domicilio:</label>
        <input type="text" name="domicilio"><br>
        
        <label>Especialidad:</label>
        <select name="especialidad_id">
                <?php
                $especialidades = $especialidad->obtenerEspecialidades();

                foreach ($especialidades as $esp) {
                    echo "<option value='" . $esp["id"] . "'>" . $esp["nombre"] . "</option>";
                }
                ?>
                <!-- <option>Traumatologia</option>
                <option>Pediatria</option>
                <option>Radiologia</option>
                <option>Nose</option> -->

        </select><br>
        <label>Disponibilidad:</label>
        <input type="text" name="disponibilidad"><br>
        
        <label>DNI:</label>
        <input type="text" name="dni"><br>
        
        <input type="submit" value="Crear Médico">
    </form>

    <h2>Listado de Médicos</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Apellido y Nombre</th>
            <th>Domicilio</th>
            <th>Especialidad</th>
            <th>Disponibilidad</th>
            <th>DNI</th>
            <th>Acciones</th>
        </tr>
    <?php
    if (empty($medicos)) {
        echo "No se encontraron médicos.";
    } else {
        foreach ($medicos as $med) {
            echo "<tr>";
            echo "<td>" . $med["id"] . "</td>";
            echo "<td>" . $med["apellido_nombre"] . "</td>";
            echo "<td>" . $med["domicilio"] . "</td>";
            echo "<td>" . $med["especialidad_nombre"] . "</td>";
            echo "<td>" . $med["disponibilidad"] . "</td>";
            echo "<td>" . $med["dni"] . "</td>";;
            echo "<td><a href='EditarMedicos.php?id=" . $med["id"] . "'>Editar</a> | <a href='FormularioMedicos.php?id=" . $med["id"] . "'>Eliminar</a></td>";
            echo "</tr>";
        }
    }

    $conn->close();

    ?>
    </table>
    
    </section>
    <footer>

    </footer>
</body>
</html>