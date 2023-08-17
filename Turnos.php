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
                    $sql = "SELECT t.id, t.fecha_hora, m.apellido_nombre AS medico_nombre
                            FROM turnos t
                            LEFT JOIN medicos m ON t.medico_id = m.id
                            WHERE t.paciente_id IS NOT NULL";
            
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

            $turno = new Turno($conn);

            
        ?>
    </body>
</html>