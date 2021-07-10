<?php

require '../../config/app.php';
isAuth_alumno();

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
    <?php include '../../Alumno/templates/header.html' ?>

    <div class="chat-grid">
        <div class="chat-select-container">
            <div class="chat-select chat-select--create">
                <div class="content">
                    <h3 class="option__heading">Crea un chat</h3>
                    <p>Entra aquí para crear un chat de alguna materia</p>

                    <a href="#">Crear</a>
                </div>
                <div class="filter-option"></div>
            </div>

            <div class="chat-select chat-select--join">
                <div class="content">
                <h3 class="option__heading">Unete a un chat</h3>
                    <p>Entra aquí para unirte a un chat ya existente</p>

                    <a href="#">Unirse</a>
                </div>
                <div class="filter-option"></div>
            </div>
        </div>

    </div>

    </body>

</html>