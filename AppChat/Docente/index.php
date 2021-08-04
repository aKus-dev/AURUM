<?php

require '../../config/app.php';
isAuth_docente();

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
    <title>AURUM: Chat</title>
</head>
<body>
    <div class=" alumno-container">
    <?php include '../../AppDocente/templates/header.html' ?>

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
                    <h3 class="option__heading">Historial</h3>
                    <p class="option__text">Accede a tu historial de chats</p>

                    <a href="/AppChat/Docente/historial.php" class="admin-button">Visualizar</a>
                </div>

                <div class="filter-option"></div>
            </div>

        </div>

        </body>

</html>