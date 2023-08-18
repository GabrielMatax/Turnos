<?php
class Especialidad {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function crearEspecialidad($nombre) {
        $nombre = $this->conn->real_escape_string($nombre);

        $sql = "INSERT INTO especialidad (nombre) VALUES ('$nombre')";
        if ($this->conn->query($sql)) {
            return $this->conn->insert_id;
        } else {
            return false;
        }
    }

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