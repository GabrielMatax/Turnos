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
    <!-- <section> 
        <form method="post" action="form.php">
        <p>Ingrese su nombre:</p> <br>
        <input type="text" name="nombre">
        <p>Ingrese su apellido:</p> <br>
        <input type="text" name="apellido">
        <p>Ingrese su correo:</p> <br>
        <input type="email" name="correo">
        <input type="submit" value="confirmar">
        <p>Ingrese primer valor:</p>
        <input type="checkbox" name="check1">pedriatra
        <br>
        

        </form>

        <h1>Gestión de Médicos</h1>
    
    </section>  -->
    <section>   
    <h1>Gestión de Médicos</h1>
    
    <form action="form.php" method="post">
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
    include 'Conexion.php';
    include 'Medicos.php';

    $medico = new Medico($conn);
    $medicos = $medico->obtenerMedicos();

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

   // $conn->close(); -->

   ?>

    <form action="formturno.php" method="post">
        <label>Seleccionar Médico:</label>
        <select name="medico_id">
        <?php
        $medicos = $medico->obtenerMedicos();

        foreach ($medicos as $med) {
            echo "<option value='" . $med["id"] . "'>" . $med["apellido_nombre"] . "</option>";
        }
        ?>
        </select><br>
        <br>
        
        <label>Fecha y Hora:</label>
        <input type="text" name="fecha_hora"><br>
        
        <input type="submit" value="Sacar Turno">
    </form>

    <h2>Listado de Turnos Asignados</h2>

    <?php
    include 'Pacientes.php';
    include 'Turnos.php';

    $turnosAsignados = $turno->obtenerTurnos();

    if (empty($turnosAsignados)) {
        echo "No se encontraron turnos asignados.";
    } else {
        foreach ($turnosAsignados as $turno) {
            echo "ID Turno: " . $turno["id"] . "<br>";
            echo "Fecha y Hora: " . $turno["fecha_hora"] . "<br>";
            echo "Médico: " . $turno["medico_nombre"] . "<br>";
            echo "-----------------------------------<br>";
        }
    }

   // $conn->close();
    ?>

    </section>
    <footer>

    </footer>
</body>
</html>