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
    include 'Especialidades.php';

    $paciente = new Paciente($conn);
    $turno = new Turno($conn);
    $medico = new Medico($conn);
    $especialidad = new Especialidad($conn);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $medicoId = $_POST["medico_id"];
        $fechaHora = $_POST["fecha_hora"];
        $pacienteId = $_POST["paciente_id"];
        $especialidadId = $_POST["especialidad_id"]; // Obtener la especialidad seleccionada

        $medicoInfo = $medico->obtenerMedicoPorId($medicoId);
        $especialidadMedico = $especialidad->obtenerEspecialidadPorId($medicoInfo["especialidad_id"])["nombre"];

        // Verificar disponibilidad directamente en el objeto Medico
        if ($medico->verificarDisponibilidad($medicoId, $fechaHora)) {
            $medicoInfo = $medico->obtenerMedicoPorId($medicoId);
            $especialidadMedico = $especialidad->obtenerEspecialidadPorId($medicoInfo["especialidad_id"])["nombre"];
            
            $especialidadSeleccionada = $especialidad->obtenerEspecialidadPorId($especialidadId)["nombre"];
            
            if ($especialidadMedico === $especialidadSeleccionada) {
                if ($paciente->sacarTurno($medicoId, $pacienteId, $fechaHora, $especialidadId)) {
                    echo "Turno asignado exitosamente.";
                } else {
                    echo "Error al asignar turno.";
                }
            } else {
                echo "El médico no tiene la especialidad seleccionada.";
            }
        } else {
            echo "El médico no está disponible en la fecha y hora seleccionadas.";
        }
    }
    //ELIMINAR
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
        $turnoId = $_GET["id"];
    
        if ($turno->eliminarTurno($turnoId)) {
            echo "Turno eliminado exitosamente.";
        } else {
            echo "Error al eliminar.";
        }
    }
    ?>

<section>
    <form action="FormularioTurnos.php" method="post">
            <label>Seleccionar Especialidad:</label>
            <select autofocus name="especialidad_id">
            <?php
                $especialidades = $especialidad->obtenerEspecialidades();

                foreach ($especialidades as $esp) {
                    echo "<option value='" . $esp["id"] . "'>" . $esp["nombre"] . "</option>";
                }
            ?>
            </select>
            <label>Seleccionar Médico:</label>
             <select autofocus name="medico_id">
            <?php
                $medicos = $medico->obtenerMedicos();

                foreach ($medicos as $med) {
                    echo "<option value='" . $med["id"] . "'>" . $med["apellido_nombre"] ."  (".$med["especialidad_nombre"] .")</option>";
                }
            ?>
            </select><br>

            <label>Paciente:</label>
            <select name="paciente_id">
            <?php
                $ultimoPaciente = end($paciente->obtenerPacientes());

                if ($ultimoPaciente) {
                    echo "<option value='" . $ultimoPaciente["id"] . "'>" . $ultimoPaciente["nombre"] ." ". $ultimoPaciente["apellido"] . "</option>";
                }
            ?>
            </select><br>
            
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

            echo "<td><a href='FormularioTurnos.php?id=" . $turno["id"] . "'>Eliminar</a></td>";
        }
    }
    $conn->close();
    ?>
</body>
</html>