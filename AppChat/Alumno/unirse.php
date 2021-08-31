<?php

require '../../config/app.php';
require '../../clases/Sistema.php';
require '../../clases/Chat.php';

isAuth_alumno();
Chat::offlineAlumno($_SESSION['id'], $db);



$id = $_SESSION['id'];
$grupos = [];
$gruposFormateados = [];

$sql = "SELECT grupo FROM grupos_alumno WHERE idAlumno = $id ORDER BY grupo ASC";
$result = $db->query($sql);
$actual = 'filter-violet sky';

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $grupos[] = $row['grupo'];
}

$entroChat = false; // Verifica si hay chats creados
$gruposCopia = $grupos;
$gruposFormateados = Sistema::formatearGrupos($gruposCopia, $db);

$i = 0;

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
    <title>AURUM: Empezemos</title>
</head>
<body style="overflow-x: hidden">
    <div class=" alumno-container">

      <!-- Caso de que no este en el rango de horarios -->
      <?php if (!empty($_GET['errorHorario'])) : ?>
            <div class="text-center width100">
                <p id="danger" class="alert-warning">No te encuentras dentro del horario del docente. Para ver sus horarios haga <a style="color: white; font-weight: bold;" href="/AppAlumno/internal/profesores.php">click aquí</a> </a>
                </p>
            </div>
        <?php endif; ?>

        <?php include '../../AppAlumno/templates/header.html' ?>

        <div class="chat-materia">
            <div class="materias-container-chat">
                <?php foreach ($grupos as $grupo) :
                    // Me quedo solo con la parte entera del grupo
                    $grado = substr($grupo, 0, -2);

                    $idUsuarioChat = Chat::getIdAlumno($id, $db);
                    $mensajeMostrado = false;  // Pasa a true cuando ya se haya mostrado

                    $sql = "SELECT id, asignatura FROM chat WHERE idHost != $idUsuarioChat AND grupo = '$grupo'";
                    $result = $db->query($sql);

                ?>

                    <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) : ?>

                        <?php if (!$mensajeMostrado) : ?>
                            <p  class="grupos-docente-list bg-main title-grupo-chat" style="text-transform: uppercase; font-weight: bold;">
                                Chats de <?php echo $gruposFormateados[$i]; ?>
                                <?php $i++ ?>
                            </p>
                        <?php
                            $mensajeMostrado = true;
                        endif;
                        ?>

                        <?php $entroChat = true ?>
                        <?php $asignatura = $row['asignatura']; ?>
                        <?php $actual === 'filter-violet sky' ? $actual = 'filter-darkviolet wave' : $actual = 'filter-violet sky' ?>

                        <form action="./internal/gestionar_unirse.php" method="POST">
                            <div class="materia <?php echo $actual ?>">
                                <h3><?php echo $asignatura ?></h3>
                                <button>Unirse</button>


                                <?php
                                $idAlumno = $_SESSION['id'];
                                $nombreAlumno = $_SESSION['nombre'];
                                $apellidoAlumno = $_SESSION['apellido'];
                                $emailAlumno = $_SESSION['email'];
                                ?>

                                <input type="hidden" name="idChat" value="<?php echo $row['id'] ?>">
                                <input type="hidden" name="idUsuario" value="<?php echo $_SESSION['id'] ?>">
                                <input type="hidden" name="nombre" value="<?php echo $_SESSION['nombre'] ?>">
                                <input type="hidden" name="apellido" value="<?php echo  $_SESSION['apellido'] ?>">
                                <input type="hidden" name="email" value="<?php echo  $_SESSION['email'] ?>">

                                <div class="<?php echo $actual ?>"></div>
                            </div>
                        </form>

                    <?php endwhile; ?>
                <?php endforeach; ?>

                <?php if (!$entroChat) : ?>
                    <div class="no-consultas bg-main text-center">
                        <p>Aún no hay chats creados por otros usuarios</p>
                    </div>
                <?php endif; ?>

                <?php $i = 0 // Por las dudas lo vuelvo a igualar a 0 
                ?>
            </div>

            </body>

            <script src="/build/js/removeAlert.js"></script>

</html>