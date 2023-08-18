<?php
class Especialidad {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // public function crearEspecialidad() {
    //     $especialidades = ["Traumatología", "Pediatría", "Cardiología", "Dermatología", "Oftalmología"];
    
    //     foreach ($especialidades as $esp) {
    //         $sql = "INSERT INTO especialidad (nombre) VALUES ('$esp')";
    
    //         $this->conn->query($sql)
    //     }
    // }

    public function obtenerEspecialidades() {
        $sql = "SELECT * FROM especialidad";
        $result = $this->conn->query($sql);

        $especialidades = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $especialidades[] = $row;
            }
        }

        return $especialidades;
    }
    public function obtenerEspecialidadPorId($especialidadId) {
        $sql = "SELECT * FROM especialidad WHERE id = $especialidadId";
        $result = $this->conn->query($sql);

        if ($result->num_rows == 1) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    public function eliminarEspecialidad($id) {
        $sql = "DELETE FROM especialidad WHERE id = $id";

        if ($this->conn->query($sql) === true) {
            return true;
        } else {
            return false;
        }
    }
    // public function obtenerNombreEspecialidad($id) {
    //     $sql = "SELECT nombre FROM especialidad WHERE id = $id";
    //     $result = $this->conn->query($sql);

    //     if ($result->num_rows > 0) {
    //         $row = $result->fetch_assoc();
    //         return $row["nombre"];
    //     } else {
    //         return "Especialidad desconocida";
    //     }
    // }

}
?>