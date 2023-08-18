<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <a href="index.php">Home</a>
    
    <?php
    include 'Conexion.php';
    include 'Pacientes.php';
    include 'Turnos.php';
    include 'Medicos.php';
    $paciente = new Paciente($conn);
    $turno = new Turno($conn);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $medicoId = $_POST["medico_id"];
        $fechaHora = $_POST["fecha_hora"];

        // Verificar disponibilidad directamente en el objeto Medico
        if ($medico->verificarDisponibilidad($medicoId, $fechaHora)) {
            if ($paciente->sacarTurno($medicoId, $fechaHora)) {
                echo "Turno asignado exitosamente.";
            } else {
                echo "Error al asignar turno.";
            }
        } else {
            echo "El médico no está disponible en la fecha y hora seleccionadas.";
        }
    }
    ?>

<section>
    <form action="FormularioTurnos.php" method="post">
            <label>Seleccionar Médico:</label>
            <select name="medico_id">
            <?php
            $medicos = $medico->obtenerMedicos();

            foreach ($medicos as $med) {
                echo "<option value='" . $med["id"] . "'>" . $med["apellido_nombre"] . "</option>";
            }
            ?>
            </select><br>
            <br>
            
            <label>Fecha y Hora:</label>
            <input type="text" name="fecha_hora"><br>
            
            <input type="submit" value="Sacar Turno">
        </form>
</section>

    <?php
    $turnosAsignados = $turno->obtenerTurnos();

    if (empty($turnosAsignados)) {
        echo "No se encontraron turnos asignados.";
    } else {
        foreach ($turnosAsignados as $turno) {
            echo "ID Turno: " . $turno["id"] . "<br>";
            echo "Fecha y Hora: " . $turno["fecha_hora"] . "<br>";
            echo "Médico: " . $turno["medico_nombre"] . "<br>";
            echo "-----------------------------------<br>";
        }
    }
 //   $conn->close();
    ?>
</body>
</html>