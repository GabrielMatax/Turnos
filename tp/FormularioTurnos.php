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
    $medico = new Medico($conn);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $medicoId = $_POST["medico_id"];
        $fechaHora = $_POST["fecha_hora"];
        $pacienteId = $_POST["paciente_id"];

        // Verificar disponibilidad directamente en el objeto Medico
        if ($medico->verificarDisponibilidad($medicoId, $fechaHora)) {
            if ($paciente->sacarTurno($medicoId, $pacienteId,$fechaHora)) {
                echo "Turno asignado exitosamente.";
            } else {
                echo "Error al asignar turno.";
            }
        } else {
            echo "El médico no está disponible en la fecha y hora seleccionadas.";
        }
    }

   /* if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $medicoId = $_POST["medico_id"];
        $fechaHora = $_POST["fecha_hora"];
    
        // Verificar disponibilidad del médico
        
        if ($medico->verificarDisponibilidad($medicoId, $fechaHora)) {
            // Obtener el paciente (supongamos que ya tienes el ID del paciente)
            $pacienteId = $_POST["paciente_id"];
            $selectedPaciente = $paciente->obtenerPacientePorId($pacienteId);
            
            // Sacar turno y vincular al paciente
            if ($selectedPaciente->sacarTurno($medicoId, $fechaHora)) {
                echo "Turno sacado exitosamente y vinculado al paciente.";
            } else {
                echo "Error al sacar el turno.";
            }
        } else {
            echo "El médico no está disponible en esa fecha y hora.";
        }
    }
    */
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
            <label>Paciente:</label>
            <select name="paciente_id">
            <?php
            $pacientes = $paciente->obtenerPacientes();

            foreach ($pacientes as $pac) {
                echo "<option value='" . $pac["id"] . "'>" . $pac["nombre"] ." ". $pac["apellido"] . "</option>";
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
            echo "Paciente: " . $turno["paciente_nombre"] . "<br>";
            echo "Fecha y Hora: " . $turno["fecha_hora"] . "<br>";
            echo "Médico: " . $turno["medico_nombre"] . "<br>";
            echo "-----------------------------------<br>";
        }
    }
 //   $conn->close();
    ?>
</body>
</html>