<html>
    <head></head>
    <body>
        <?php
            class HistoriaClinica{
                private $DniPaciente;
                private $Hora;
                private $Fecha;
                private $Consulta;
                private $Diagnostico;

                public function __construct($dni, $hora, $fecha, $consulta, $diag){
                    $this->DniPaciente=$dni;
                    $this->Hora=$hora;
                    $this->Fecha=$fecha;
                    $this->Consulta=$consulta;
                    $this->Diagnostico=$diag;
                }

                public function AgregarConsulta(){

                }
            }
            ?>
    </body>
</html>