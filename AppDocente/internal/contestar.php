<?php

require '../../config/app.php';
require '../../clases/Docente.php';
require '../../clases/Chat.php';

isAuth_docente();
Chat::offlineUsuario($_SESSION['CI'], $db);

if (empty($_GET)) {
    header('Location: /AppDocente/index.php');
}

$idConsulta = $_GET['id'];
$nombre = $_GET['n'];
$apellido = $_GET['a'];

$titulo = '';
$fecha = '';
$descripcion = '';
$success = false;


$sql = "SELECT titulo,descripcion,fecha from consultas WHERE id = $idConsulta";
$result = $db->query($sql);

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $titulo = $row['titulo'];
    $fecha = $row['fecha'];
    $descripcion = $row['descripcion'];
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {
   Docente::responderConsulta($idConsulta, $_POST['respuesta'], $db);
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
    <title>AURUM: Contestar</title>
</head>
<body>
    <div class=" alumno-container">
    <?php include '../templates/header.html' ?>

    <main class=" consulta-container">
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
                <h2>Escribe tu respuesta</h2>
            </div> 

            <form method="POST" class="respuesta-profe">
                <textarea name="respuesta" required placeholder="Escribe tu respuesta"></textarea>
                <div class="align-right contenedor-responder">
                    <button class="bg-main">Responder</button>
                </div>
            </form>
    </main>

    <script src="/build/js/removeAlert.js"></script>
    </body>

</html>