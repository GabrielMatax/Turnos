<html>
    <head></head>
    <body>
        <?php
            class Turno {
                private $conn;
            
                public function __construct($conn) {
                    $this->conn = $conn;
                }
            
                public function obtenerTurnos() {
                    $sql = "SELECT turnos.id, turnos.fecha_hora, turnos.paciente_id, medicos.apellido_nombre AS medico_nombre,
                            pacientes.nombre AS paciente_nombre
                            FROM turnos
                            LEFT JOIN medicos ON turnos.medico_id = medicos.id
                            LEFT JOIN pacientes ON turnos.paciente_id = pacientes.id
                            WHERE turnos.paciente_id IS NOT NULL AND turnos.medico_id IS NOT NULL";
            
                    $result = $this->conn->query($sql);
            
                    $turnos = array();
            
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $turnos[] = $row;
                        }
                    }
            
                    return $turnos;
                }

                public function eliminarTurno($id) {
                    $sql = "DELETE FROM turnos WHERE id = $id";
            
                    if ($this->conn->query($sql) === true) {
                        return true;
                    } else {
                        return false;
                    }
                }
            }
        ?>  
    </body>
</html>