<?php

require '../../config/app.php';
require '../../clases/Sistema.php';
require '../../clases/Chat.php';

isAuth_alumno();
Chat::offlineUsuario($_SESSION['CI'], $db);



$id = $_SESSION['id'];
$grupos = [];
$gruposFormateados = [];

$sql = "SELECT grupo FROM grupos_alumno WHERE idAlumno = $id ORDER BY grupo ASC";
$result = $db->query($sql);
$actual = 'filter-violet sky';

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $grupos[] = $row['grupo'];
}


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
<body style=" overflow-x: hidden">

    <!-- Caso de que el chat NO tenga docente -->
    <?php if (!empty($_GET['success'])) : ?>
        <div class="text-center width100">
            <p id="success" class="alert-success">El chat ha sido creado correctamente, ya puedes unirte</p>
        </div>
    <?php endif; ?>

    <div class=" alumno-container">
        <?php include '../../AppAlumno/templates/header.html' ?>

        <!-- Caso de que el chat NO tenga docente -->
        <?php if (!empty($_GET['empty'])) : ?>
            <div class="text-center width100 absolute">
                <p id="danger" class="alert-danger">La materia seleccionada aún no tiene un docente asignado</p>
            </div>
        <?php endif; ?>

        <!-- Caso de que ya este creado -->
        <?php if (!empty($_GET['created'])) : ?>
            <div class="text-center width100 absolute">
                <p id="danger" class="alert-danger">El chat ya está creado. Puedes unirte yendo a la sección anterior</p>
            </div>
        <?php endif; ?>

         <!-- Caso de que el docente aun no tenga horarios -->
         <?php if (!empty($_GET['sinHorarios'])) : ?>
            <div class="text-center width100 absolute">
                <p id="danger" class="alert-danger">El docente aún no ha registrado sus horarios, intentalo más tarde</p>
            </div>
        <?php endif; ?>

        <!-- Caso de que no este en el rango de horarios -->
        <?php if (!empty($_GET['errorHorario'])) : ?>
            <div class="text-center width100">
                <p id="danger" class="alert-warning">No te encuentras dentro del horario del docente. Para ver sus horarios haga <a style="color: white; font-weight: bold;" href="/AppAlumno/internal/profesores.php">click aquí</a> </a>
                </p>
            </div>
        <?php endif; ?>

        <div class="chat-materia">
            <div class="materias-container-chat">
                <?php
                // Me quedo solo con la parte entera del grupo
                $grado = substr($grupo, 0, -2);

                $ci = $_SESSION['CI'];
                $entroChat = false; // Verifica si hay chats creados
                $mensajeMostrado = false;  // Pasa a true cuando ya se haya mostrado

                $sql = "SELECT id, asignatura FROM chat WHERE ciHost = '$ci'";
                $result = $db->query($sql);

                ?>

                <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) : ?>

                    <?php if (!$mensajeMostrado) : ?>
                        <p id="chats-creados" class="grupos-docente-list bg-main title-grupo-chat" style="text-transform: uppercase; font-weight: bold;">
                            Tus chats creados
                        </p>
                    <?php
                        $mensajeMostrado = true;
                    endif;
                    ?>

                    <?php $entroChat = true ?>
                    <?php $asignatura = $row['asignatura']; ?>
                    <?php $actual === 'filter-violet sky' ? $actual = 'filter-darkviolet wave' : $actual = 'filter-violet sky' ?>

                    <form action="./internal/gestionar_host.php" method="POST">
                        <div class="materia <?php echo $actual ?>">
                            <h3><?php echo $asignatura ?></h3>
                            <button>Unirse</button>


                            <?php
                            $idAlumno = $_SESSION['id'];
                            $nombreAlumno = $_SESSION['nombre'];
                            $apellidoAlumno = $_SESSION['apellido'];
                            ?>

                            <input type="hidden" name="idChat" value="<?php echo $row['id'] ?>">
                            <input type="hidden" name="idUsuario" value="<?php echo $_SESSION['id'] ?>">
                            <input type="hidden" name="nombre" value="<?php echo $_SESSION['nombre'] ?>">
                            <input type="hidden" name="apellido" value="<?php echo  $_SESSION['apellido'] ?>">

                            <div class="<?php echo $actual ?>"></div>
                        </div>
                    </form>

                <?php endwhile; ?>
                <?php if (!$entroChat) : ?>
                    <div class="no-consultas bg-main text-center">
                        <p id="not-found">Aún no has creado un chat</p>
                    </div>
                <?php endif; ?>

                <?php $i = 0 // Por las dudas lo vuelvo a igualar a 0 
                ?>
            </div>

            </body>

            <script src="/build/js/removeAlert.js"></script>
            <script src="/languages/alumno/chat/header.js"></script>
            <script src="/languages/alumno/chat/hostchats.js"></script>


</html>