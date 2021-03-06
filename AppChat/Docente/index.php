<?php

require '../../config/app.php';
require '../../clases/Chat.php';

isAuth_docente();
Chat::offlineUsuario($_SESSION['CI'], $db);


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
    <title>AURUM: Selecciona</title>
</head>
<body>
    <div class=" alumno-container">
    <?php include '../../AppDocente/templates/header.html' ?>

         <!-- Caso de que el chat NO tenga docente -->
         <?php if (!empty($_GET['finish'])) : ?>
            <div class="text-center width100">
                <p id="success" class="alert-success">Chat finalizado. Se ha enviado un mail a todos los integrantes con el historial del chat</p>
            </div>
        <?php endif; ?>


    <div class="alumno-grid">
        <div class="flex-consultas">


            <div class="consulta chat-select--create">
                <div class="option__content">
                    <h3 class="option__heading option__heading--red">Mis chats</h3>
                    <p class="option__text">Chats creados por tus alumnos para ti</p>

                    <a href="/AppChat/Docente/chats.php" class="admin-button admin-button--red">Visualizar</a>
                </div>

                <div class="filter-option--diff"></div>
            </div>

            <div class="consulta chat-select--chats">
                <div class="option__content">
                    <h3 class="option__heading">Solicitudes</h3>
                    <p class="option__text">Solicitudes para un nuevo chat</p>

                    <a href="/AppChat/Docente/solicitudes.php" class="admin-button">Visualizar</a>
                </div>

                <div class="filter-option"></div>
            </div>

        </div>

        </body>

</html>