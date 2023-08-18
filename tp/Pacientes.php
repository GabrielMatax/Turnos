<html>
    <head></head>
    <body>
        <?php
           
    class Paciente {
        private $conn;
    
        public function __construct($conn) {
            $this->conn = $conn;
        }
    
        public function crearPaciente($nombre, $apellido, $domicilio, $dni, $telefono) {
            $sql = "INSERT INTO pacientes(nombre, apellido, domicilio, dni, telefono)
                    VALUES ('$nombre', '$apellido', '$domicilio', '$dni', '$telefono')";
    
            if ($this->conn->query($sql) === true) {
                return true;
            } else {
                return false;
            }
        }
    
        public function obtenerPacientes() {
            $sql = "SELECT * FROM pacientes";
            $result = $this->conn->query($sql);
    
            $pacientes = array();
    
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $pacientes[] = $row;
                }
            }
    
            return $pacientes;
        }
        public function obtenerPacientePorId($id) {
            $sql = "SELECT * FROM pacientes WHERE id = $id";
            $result = $this->conn->query($sql);
        
            if ($result->num_rows == 1) {
                return $result->fetch_assoc();
            } else {
                return null;
            }
        }
    
        public function actualizarPaciente($id, $nombre, $apellido, $domicilio, $dni, $telefono) {
            $sql = "UPDATE pacientes
                    SET nombre = '$nombre', apellido = '$apellido', domicilio = '$domicilio', dni = '$dni', telefono = '$telefono'
                    WHERE id = $id";
    
            if ($this->conn->query($sql) === true) {
                return true;
            } else {
                return false;
            }
        }
    
        public function eliminarPaciente($id) {
            $sqlDeleteTurnos = "DELETE FROM turnos WHERE paciente_id = $id";
            $this->conn->query($sqlDeleteTurnos);
            $sql = "DELETE FROM pacientes WHERE id = $id";
    
            if ($this->conn->query($sql) === true) {
                return true;
            } else {
                return false;
            }
        }

        public function sacarTurno($medicoId , $paciD,$fechaHora) {   
            $sql = "INSERT INTO turnos (medico_id, paciente_id, fecha_hora)
                    VALUES ('$medicoId','$paciD' ,'$fechaHora')";

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