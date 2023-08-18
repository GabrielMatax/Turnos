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
                    $sql = "SELECT turnos.id, turnos.fecha_hora, medicos.apellido_nombre AS medico_nombre
                            FROM turnos
                            LEFT JOIN medicos ON turnos.medico_id = medicos.id
                            WHERE turnos.paciente_id IS NULL";
            
                    $result = $this->conn->query($sql);
            
                    $turnos = array();
            
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $turnos[] = $row;
                        }
                    }
            
                    return $turnos;
                }
            }
        ?>  
    </body>
</html>