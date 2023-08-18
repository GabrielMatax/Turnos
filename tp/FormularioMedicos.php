<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
</head>
<body>
    <header>
        <h1>FORMULARIO</h1>
        <a href="index.php">Home</a>
    </header>
    <section>   
    <?php 
    include 'Conexion.php';
    include 'Medicos.php';
    $medico = new Medico($conn);
    $medicos = $medico->obtenerMedicos();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $apellidoNombre = $_POST["apellido_nombre"];
        $domicilio = $_POST["domicilio"];
        $especialidad = $_POST["especialidad"];
        $disponibilidad = $_POST["disponibilidad"];
        $dni = $_POST["dni"];

        $medico->crearMedico($apellidoNombre, $domicilio, $especialidad, $disponibilidad, $dni);
    }
    ?>
    <h1>Gestión de Médicos</h1>
    
    <form action="formmedicos.php" method="post">
        <label>Apellido y Nombre:</label>
        <input type="text" name="apellido_nombre"><br>
        
        <label>Domicilio:</label>
        <input type="text" name="domicilio"><br>
        
        <label>Especialidad:</label>
        <input type="text" name="especialidad"><br>
        
        <label>Disponibilidad:</label>
        <input type="text" name="disponibilidad"><br>
        
        <label>DNI:</label>
        <input type="text" name="dni"><br>
        
        <input type="submit" value="Crear Médico">
    </form>

    <h2>Listado de Médicos</h2>

    <?php
    if (empty($medicos)) {
        echo "No se encontraron médicos.";
    } else {
        foreach ($medicos as $med) {
            echo "ID: " . $med["id"] . "<br>";
            echo "Apellido y Nombre: " . $med["apellido_nombre"] . "<br>";
            echo "Domicilio: " . $med["domicilio"] . "<br>";
            echo "Especialidad: " . $med["especialidad"] . "<br>";
            echo "Disponibilidad: " . $med["disponibilidad"] . "<br>";
            echo "DNI: " . $med["dni"] . "<br>";
            echo "-----------------------------------<br>";
        }
    }

    ?>
    
    </section>
    <footer>

    </footer>
</body>
</html>