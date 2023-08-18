<?php
class Especialidad {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
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
    public function obtenerEspecialidadPorId($especialidadId) {
        $sql = "SELECT * FROM especialidad WHERE id = $especialidadId";
        $result = $this->conn->query($sql);

        if ($result->num_rows == 1) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

}
?>