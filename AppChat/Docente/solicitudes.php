<?php

require '../../config/app.php';
require '../../clases/Sistema.php';
require '../../clases/Chat.php';

isAuth_docente();
Chat::offlineUsuario($_SESSION['CI'], $db);

$entro = false;
$id = $_SESSION['id'];
$grupos = [];
$gruposFormateados = [];

$sql = "SELECT grupo FROM grupos_docente WHERE idDocente = $id ORDER BY grupo ASC";
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
    <title>AURUM: Tus chats</title>
</head>
<body style=" overflow-x: hidden">

    <!-- Caso de que el chat NO tenga docente -->
    <?php if (!empty($_GET['success'])) : ?>
        <div class="text-center width100">
            <p id="success" class="alert-success">El chat ha sido aceptado con éxito</p>
        </div>
    <?php endif; ?>

    <div class="alumno-container">
        <?php include '../../AppDocente/templates/header.html' ?>

        <div class="chat-materia">
            <div class="materias-container-chat">
                <?php foreach ($grupos as $grupo) :
                    // Me quedo solo con la parte entera del grupo
                    $grado = substr($grupo, 0, -2);

                    $ciDocente = $_SESSION['CI'];;
                    $entroChat = false; // Verifica si hay chats creados

                    $sql = "SELECT id, ciHost, nombreHost, apellidoHost, emailHost, asignatura, grupo FROM solicitud_chat WHERE ciDocente = '$ciDocente' AND grupo = '$grupo'";

                    $result = $db->query($sql);

                ?>

                    <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) : ?>
                        <?php $entro = true; ?>

                        <?php
                        $entroChat = true;
                        $asignatura = $row['asignatura'];
                        $grupo = $row['grupo'];
                        $nombreHost = $row['nombreHost'];
                        $apellidoHost = $row['apellidoHost'];
                        $emailHost = $row['emailHost'];
                        $actual === 'filter-violet sky' ? $actual = 'filter-darkviolet wave' : $actual = 'filter-violet sky'
                        ?>


                        <div class="materia <?php echo $actual ?>">
                            <h3><?php echo $asignatura ?></h3>
                            <span class="data-solicitud"> Creado por: <?php echo $nombreHost . " " . $apellidoHost ?> </span>
                            <span class="data-solicitud"> Grupo: <?php echo $grupo ?> </span>

                            <div class="solicitudes-buttons">
                                <form action="internal/aceptar_solicitud.php" method="POST">
                                    <!-- Datos del alumno -->
                                    <input type="hidden" name="ciHost" value="<?php echo $row['ciHost'] ?>">
                                    <input type="hidden" name="nombreHost" value="<?php echo $row['nombreHost'] ?>">
                                    <input type="hidden" name="apellidoHost" value="<?php echo $row['apellidoHost'] ?>">
                                    <input type="hidden" name="emailHost" value="<?php echo $row['emailHost'] ?>">

                                    <!-- Datos del chat -->
                                    <input type="hidden" name="asignatura" value="<?php echo  $row['asignatura'] ?>">
                                    <input type="hidden" name="grupo" value="<?php echo  $row['grupo'] ?>">
                                    <input type="hidden" name="idSolicitud" value="<?php echo  $row['id'] ?>">

                                    <!-- Datos del docente -->
                                    <input type="hidden" name="ciDocente" value="<?php echo  $_SESSION['CI'] ?>">
                                    <input type="hidden" name="nombreDocente" value="<?php echo  $_SESSION['nombre'] ?>">
                                    <input type="hidden" name="apellidoDocente" value="<?php echo  $_SESSION['apellido'] ?>">
                                    <input type="hidden" name="emailDocente" value="<?php echo  $_SESSION['email'] ?>">

                                    <button style="border: none; width: 5rem;"><i style="font-size: 3.5rem" class="fas fa-check-square"></i></button>
                                </form>

                                <!-- Rechazar -->
                                <form action="internal/rechazar_solicitud.php" method="POST">
                                    <input type="hidden" name="idSolicitud" value="<?php echo  $row['id'] ?>">

                                    <button style="border: none; width: 5rem;"><i style="font-size: 3.5rem" class="fas fa-window-close"></i></button>
                                </form>
                            </div>


                            <?php
                            $idAlumno = $_SESSION['id'];
                            $nombreAlumno = $_SESSION['nombre'];
                            $apellidoAlumno = $_SESSION['apellido'];
                            ?>


                            <div class="<?php echo $actual ?>"></div>
                        </div>


                    <?php endwhile; ?>
                <?php endforeach; ?>

                <?php if (!$entro) : ?>
                    <div class="no-consultas bg-main text-center">
                        <p>Aún no hay solicitudes de chats pendientes</p>
                    </div>
                <?php endif; ?>



                <?php $i = 0 // Por las dudas lo vuelvo a igualar a 0 
                ?>
            </div>

            </body>

            <script src="/build/js/removeAlert.js"></script>

</html>