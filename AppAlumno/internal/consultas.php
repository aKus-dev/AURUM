<?php

require '../../config/app.php';
require '../../clases/Chat.php';

isAuth_alumno();
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
    <title>AURUM: Consultas</title>
</head>
<body>
    <div class=" alumno-container">
        <?php include '../templates/header.html' ?>

        <main class=" consulta-container">
            <h2>Consultas</h2>

            <div class="flexRow buttons-container">
                <div class="consulta-buttons">
                    <button class="btn-realizadas btn-realizadas--active" id="realizada">Realizadas</button>
                    <button class="btn-pendientes" id="pendiente">Contestadas</button>
                    <button class="btn-contestadas" id="contestada">Recibidas</button>
                </div>
            </div>

            <div id="realizada-container">
                <?php require 'estados/realizada.php'; ?>
            </div>

            <div id="pendiente-container" class="display-none">
                <?php require 'estados/contestada.php'; ?>
            </div>

            <div id="contestada-container" class="display-none">
                <?php require 'estados/recibida.php'; ?>
            </div>


        </main>

    </div>

    <script src="/build/js/consultas.js"></script>
    <script src="/languages/alumno/consultas.js"></script>
    <script src="/languages/alumno/header.js"></script>
    </body>

</html>