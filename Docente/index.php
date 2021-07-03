<?php

require '../config/app.php';
isAuth_docente();

$success = false;
$type = '';

if(!empty($_GET)) {
    $success = $_GET['success'];
    $type = $_GET['type'];
} 

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
    <title>AURUM: Docente</title>
</head>
<body>
    <div class=" alumno-container">
    <?php include 'templates/header.html' ?>

             <!-- Se registro correctamente-->
             <?php if ($success && $type="enviada") : ?>
               <div class="text-center">
                 <p id="success" class="alert-success">Respuesta enviada correctamente</p>
               </div>
            <?php endif; ?>

    <div class="alumno-grid">
        <div class="flex-consultas">

            <div class="consulta consulta--consultas">
                <div class="option__content">
                    <h3 class="option__heading">Consultas</h3>
                    <p class="option__text">Visualiza todas las consultas de tus alumnos</p>

                    <a href="internal/consultas.php" class="admin-button">Visualizar</a>
                </div>

                <div class="filter-option"></div>
            </div>

            <div class="consulta consulta--profesores">
                <div class="option__content">
                    <h3 class="option__heading">Alumno</h3>
                    <p class="option__text">Ve una lista con todos tus alumnos</p>

                    <a href="#" class="admin-button">Visualizar</a>
                </div>

                <div class="filter-option"></div>
            </div>

            <div class="consulta consulta--compas">
                <div class="option__content">
                    <h3 class="option__heading">Grupos</h3>
                    <p class="option__text">Ve una lista con todos tus grupos</p>

                    <a href="#" class="admin-button">Visualizar</a>
                </div>

                <div class="filter-option"></div>
            </div>
        </div>

        <div class="consulta consulta--horarios">
            <div class="option__content">
                <h3 class="option__heading option__heading--red">Registra tus horarios</h3>
                <p class="option__text">Registra cuando te pueden hacer consultas</p>

                <a href="#" class="admin-button admin-button--red">Registrar</a>
            </div>

            <div class="filter-option--diff"></div>
        </div>

    </div>

    </div>

    <script src="/build/js/removeAlert.js"></script>
    </body>
</html>