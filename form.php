<html>
    
    <a href="index.php">casa</a>
    <a href="formulario.php">Formulario</a>
</html>

<?php 
    include 'Conexion.php';
    include 'Medicos.php';


   // $nombres = $_POST['nombre'];
   // $apellido = $_POST['apellido']; 
    
    
    /*$compl= $_REQUEST['nombre'] ."  " . $_REQUEST['apellido'];

   // echo "<p>El nombre es $compl</p>";

    if (isset($_REQUEST['check1']) && $pedr>0){

        $pedr--;
        echo "Quedan $pedr pedriatas". "<br>";
        
    }*/

    // agregar($nombres,$apellido);




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $apellidoNombre = $_POST["apellido_nombre"];
    $domicilio = $_POST["domicilio"];
    $especialidad = $_POST["especialidad"];
    $disponibilidad = $_POST["disponibilidad"];
    $dni = $_POST["dni"];

    $medico->crearMedico($apellidoNombre, $domicilio, $especialidad, $disponibilidad, $dni);
}


header("Location: index.php");
?>