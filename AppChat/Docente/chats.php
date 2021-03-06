<?php

require '../../config/app.php';
require '../../clases/Sistema.php';
require '../../clases/Chat.php';

isAuth_docente();
Chat::offlineUsuario($_SESSION['CI'], $db);

$entroChat = false; // Verifica si hay chats creados
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
<body style="overflow-x: hidden">
    <div class=" alumno-container">
        <?php include '../../AppDocente/templates/header.html' ?>

        <div class="chat-materia">
            <div class="materias-container-chat">
                <?php foreach ($grupos as $grupo) :
                    // Me quedo solo con la parte entera del grupo
                    $grado = substr($grupo, 0, -2);

                    $ciDocente = $_SESSION['CI'];;
                    $mensajeMostrado = false;  // Pasa a true cuando ya se haya mostrado

                    $sql = "SELECT id, asignatura FROM chat WHERE ciDocente = '$ciDocente' AND grupo = '$grupo'";

             
                    $result = $db->query($sql);

                ?>

                    <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) : ?>

                        <?php if (!$mensajeMostrado) : ?>
                            <p  class="grupos-docente-list bg-main title-grupo-chat" style="text-transform: uppercase; font-weight: bold;">
                                Chats de <?php echo $grupo; ?>
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
                                ?>

                                <input type="hidden" name="idChat" value="<?php echo $row['id'] ?>">
                                <input type="hidden" name="ciDocente" value="<?php echo $_SESSION['CI'] ?>">
                                <input type="hidden" name="nombre" value="<?php echo $_SESSION['nombre'] ?>">
                                <input type="hidden" name="apellido" value="<?php echo  $_SESSION['apellido'] ?>">

                                <div class="<?php echo $actual ?>"></div>
                            </div>
                        </form>

                    <?php endwhile; ?>
                <?php endforeach; ?>

                <?php if (!$entroChat) : ?>
                    <div class="no-consultas bg-main text-center">
                        <p>A??n no hay chats creados por otros usuarios</p>
                    </div>
                <?php endif; ?>

                <?php $i = 0 // Por las dudas lo vuelvo a igualar a 0 
                ?>
            </div>

            </body>

            <script src="/build/js/removeAlert.js"></script>

</html>