<html>
    <head></head>
    <body>
        <?php
            /*class Pacientes{
                private $Nombre;
                private $Dni;
                private $NombreTutor;
                private $Domicilio;
                private $Celular;

                public function __construct($nombre, $dni, $nomTutor, $domic, $cel){
                    $this->Nombre=$nombre;
                    $this->Dni=$dni;
                    $this->NombreTutor=$nomTutor;
                    $this->Domicilio=$domic;
                    $this->Celular=$cel;
                }
                public function agregar($nombres, $apellido){
                    // Check the connection.
                    $conn = mysqli_connect("localhost", "root", "", "tpcudi");
                    if ($conn === false) {
                        die("Error connecting to MySQL: " . mysqli_connect_error());
                    }
                    try {
                        $conn = mysqli_connect("localhost", "root", "", "tpcudi");
                    } catch (\Throwable $th) {
                        echo("Error connecting to MySQL: " . mysqli_connect_error());
                    }
                    $sql = "INSERT INTO medicos(nombre, apellido) VALUES ('$nombres', '$apellido')";
                    $result = mysqli_query($conn, $sql);
                    if ($result === false) {
                        die("Error inserting data into MySQL: " . mysqli_error($conn));
                    }
                    mysqli_close($conn);
                }
                public function ConsultarHistoria(){
                    
                }
                
            }*/


    class Paciente {
        private $conn;

        public function __construct($conn) {
            $this->conn = $conn;
        }

        public function sacarTurno($medicoId, $fechaHora) {   
            $sql = "INSERT INTO turnos (medico_id, paciente_id, fecha_hora)
                    VALUES ($medicoId, NULL, '$fechaHora')";

            if ($this->conn->query($sql) === true) {
                return true;
            } else {
                return false;
            }
        }
    }

    $paciente = new Paciente($conn);

        ?>
    </body>
</html>