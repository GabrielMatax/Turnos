<html>
    <head></head>
    <body>
        <?php
            class Especialidades{
                private $Codigo;
                private $Nombre;
                private $Dias;
                private $Horarios;
                private $Medico;

                public function __construct($cod, $nombre, $dias, $hor, $medico){
                    $this->Codigo=$cod;
                    $this->Nombre=$nombre;
                    $this->Dias=$dias;
                    $this->Horarios=$hor;
                    $this->Medico=$medico;
                }

                public function Listado(){

                }
            }
        ?>
    </body>
</html>