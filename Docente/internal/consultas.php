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
    <link rel="icon" type="image/png" href="../build/img/AURUM_color.svg">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link rel="stylesheet" href="/build/css/app.css"">
    <title>AURUM: Alumno</title>
</head>
<body>
    <div class=" alumno-container">
    <?php include '../templates/header.html' ?>

    <main class=" consulta-container">
        <h2>Consultas</h2>

        <div class="flexRow buttons-container">
            <div class="consulta-buttons">
                <button class="btn-pendientes btn-pendientes--active" id="pendiente">Recibidas</button>
                <button class="btn-contestadas" id="contestada">Contestadas</button>
            </div>

        </div>

        <div id="pendiente-container">
            <?php require 'estados/pendiente.php' ?> 
        </div>

        <div id="contestada-container" class="display-none"> 
        <?php require 'estados/contestada.php' ?> 
        </div>
    </main>

    <script src="/build/js/consultas.js"></script>
    </body>

</html>