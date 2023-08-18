<html>
    <head>
        <title>Prueba</title>
    </head>
    <body>
    <?php

class Medico {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function crearMedico($apellidoNombre, $domicilio, $especialidad, $disponibilidad, $dni) {
        $sql = "INSERT INTO medicos (apellido_nombre, domicilio, especialidad, disponibilidad, dni)
                VALUES ('$apellidoNombre', '$domicilio', '$especialidad', '$disponibilidad', '$dni')";

        if ($this->conn->query($sql) === true) {
            return true;
        } else {
            return false;
        }
    }

    public function obtenerMedicos() {
        $sql = "SELECT * FROM medicos";
        $result = $this->conn->query($sql);

        $medicos = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $medicos[] = $row;
            }
        }

        return $medicos;
    }
    public function obtenerMedicoPorId($id) {
        $sql = "SELECT * FROM medicos WHERE id = $id";
        $result = $this->conn->query($sql);
    
        if ($result->num_rows == 1) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    public function actualizarMedico($id, $apellidoNombre, $domicilio, $especialidad, $disponibilidad, $dni) {
        $sql = "UPDATE medicos SET 
                apellido_nombre = '$apellidoNombre',
                domicilio = '$domicilio',
                especialidad = '$especialidad',
                disponibilidad = '$disponibilidad',
                dni = '$dni'
                WHERE id = $id";

        if ($this->conn->query($sql) === true) {
            return true;
        } else {
            return false;
        }
    }

    public function eliminarMedico($id) {
        $sql = "DELETE FROM medicos WHERE id = $id";

        if ($this->conn->query($sql) === true) {
            return true;
        } else {
            return false;
        }
    }

    
   /* public function verificarDisponibilidad($medicoId, $fechaHora) {
        $sql = "SELECT * FROM disponibilidad
                WHERE medico_id = $medicoId
                AND fecha_hora = '$fechaHora'";
        
        $result = $this->conn->query($sql);
    
        return ($result->num_rows > 0); // Retorna true si el médico está disponible, false si no lo está
    }*/
    
    public function verificarDisponibilidad($medicoId, $fechaHora) {
        $sql = "SELECT disponibilidad FROM medicos
                WHERE id = $medicoId";
    
        $result = $this->conn->query($sql);
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $disponibilidad = $row["disponibilidad"];
    
            $diaSeleccionado = $fechaHora; // Obtener el día de la semana en formato "Lunes", "Martes", etc.
    
            if ($disponibilidad == $diaSeleccionado){
                return true; // La fecha y hora están en la disponibilidad
            }
        }
    
        return false; // El médico no está disponible
    }
    

}

$medico = new Medico($conn);
?>
    </body>
</html>