<?php

require '../../config/app.php';
require '../../clases/Alumno.php';
require '../../clases/Chat.php';

isAuth_alumno();
Chat::offlineUsuario($_SESSION['CI'], $db);



if (empty($_POST)) {
    header('Location: /AppAlumno/index.php');
}

$idConsulta = $_POST['id'];
$nombre = $_POST['nombre_alumno'];
$apellido = $_POST['apellido_alumno'];

$nombreDocente = $_POST['nombre_docente'];
$apellidoDocente = $_POST['apellido_docente'];

$titulo = '';
$fecha = '';
$descripcion = '';
$respuesta = '';

// Pasar la consulta recibida
$sqlActualizar =  "UPDATE consultas SET estado = 'recibida' WHERE id=$idConsulta;";
$db -> query($sqlActualizar);


// Obtener la respuesta del profesores
$sqlProfesor = "SELECT respuesta from consultas WHERE id = $idConsulta";
$resultado = $db->query($sqlProfesor);

while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
    $respuesta = $row['respuesta'];
}


$sql = "SELECT titulo,descripcion,fecha from consultas WHERE id = $idConsulta";
$result = $db->query($sql);

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $titulo = $row['titulo'];
    $fecha = $row['fecha'];
    $descripcion = $row['descripcion'];
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="/build/img/AURUM_color.svg">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link rel="stylesheet" href="/build/css/app.css"">
    <title>AURUM: Consulta</title>
</head>
<body>
    <div class=" alumno-container">
    <?php include '../templates/header.html' ?>

    <main class="consulta-container">
        <div>
            <div class="cargar-datos-consulta">
                <h3 class="option__heading"> <?php echo $titulo ?> </h3>

                <div class="datos-alumno">
                    <p>Enviado por: <span class="text-violet"> <?php echo $nombre . " " . $apellido  ?> </span> </p>
                    <p>Fecha: <span class="text-violet"> <?php echo $fecha ?> </span> </p>
                </div>

              <div class="text-center">
                 <p class="d-alumno"> <?php echo $descripcion ?>  </p>
              </div>
            </div>
            <div>
                <h2>Respuesta de <?php echo $nombreDocente . " " . $apellidoDocente ?> </h2>
            </div> 

            <div class="text-center">
                 <p class="r-profesor"><?php echo $respuesta ?></p>
            </div>
            
    </main>

    <script src="/build/js/consultas.js"></script>
    </body>

</html>