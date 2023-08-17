<?php
include 'Conexion.php';
include 'Formulario.php';

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
