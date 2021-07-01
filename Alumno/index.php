<?php

require '../config/app.php';
isAuth_alumno();

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
    <?php include 'templates/header.html' ?>

    <div class="alumno-grid">
        <div class="flex-consultas">

            <div class="consulta consulta--consultas">
                <div class="option__content">
                    <h3 class="option__heading">Consultas</h3>
                    <p class="option__text">Visualiza todas tus consultas ralizadas</p>

                    <a href="internal/consultas.php" class="admin-button">Visualizar</a>
                </div>

                <div class="filter-option"></div>
            </div>

            <div class="consulta consulta--profesores">
                <div class="option__content">
                    <h3 class="option__heading">Profesores</h3>
                    <p class="option__text">Ve una lista con todos tus profesores</p>

                    <a href="#" class="admin-button">Visualizar</a>
                </div>

                <div class="filter-option"></div>
            </div>

            <div class="consulta consulta--compas">
                <div class="option__content">
                    <h3 class="option__heading">Clase</h3>
                    <p class="option__text">Ve una lista con todos tus compañeros</p>

                    <a href="#" class="admin-button">Visualizar</a>
                </div>

                <div class="filter-option"></div>
            </div>
        </div>
    </div>

    


    </div>

    </body>

</html>