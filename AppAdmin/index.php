<?php 

require '../config/app.php';
isAuth_admin();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../build/img/AURUM_color.svg">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css"
        integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link rel="stylesheet" href="../build/css/app.css"">
    <title>AURUM: Administración</title>
</head>
<body>

   <?php include 'templates/header.php'; ?>

    <main class="option-container">
        <div class="option option--teacher">
            <div class="option__content">
                <h3 class="option__heading">DOCENTES</h3>
                <p class="option__text">Agrega, modifica y elimina docentes</p>

                <a href="internal/docentes.php" class="admin-button">ADMINISTRAR</a>
            </div>

            <div class="filter-option"></div>
        </div>

        <div class="option option--students">
            <div class="option__content">
                <h3 class="option__heading">ALUMNOS</h3>
                <p class="option__text">Agrega, modifica y elimina alumnos</p>

                <a href="internal/ABM_Alumno/create.php" class="admin-button">ADMINISTRAR</a>
            </div>

            <div class="filter-option"></div>
        </div>

        <div class="option option--books">
            <div class="option__content">
                <h3 class="option__heading">ASIGNATURAS</h3>
                <p class="option__text">Agrega, modifica y elimina asginaturas</p>

                <a href="internal/asignaturas.php" class="admin-button">ADMINISTRAR</a>
            </div>

            <div class="filter-option"></div>
        </div>
    </main>

    <section class="option-container">
        <div class="option option--red option--agenda">
            <div class="option__content">
                <h3 class="option__heading option__heading--red">AGENDA</h3>
                <p class="option__text">Accede a la agenda de consultas realizadas</p>

                <a href="internal/agenda.php" class="admin-button admin-button--red"">ACCEDER</a>
            </div>

            <div class="filter-option--diff"></div>
        </div>

        <div class="option option--red option--pendiente">
            <div class="option__content">
                <h3 class="option__heading option__heading--red">PENDIENTE</h3>
                <p class="option__text">Visualiza los alumnos pendientes de aprobación</p>

                <a href="internal/pendiente.php" class="admin-button admin-button--red"">ACCEDER</a>
            </div>

            <div class="filter-option--diff"></div>
        </div>

        <div class="option option--red option--grupo">
            <div class="option__content">
                <h3 class="option__heading option__heading--red">GRUPOS</h3>
                <p class="option__text">Crea nuevos grupos y orientaciones.</p>

                <a href="internal/grupos.php" class="admin-button admin-button--red">ACCEDER</a>
            </div>

            <div class="filter-option--diff"></div>
        </div>
    </section>


   

    <footer class="footer">
        <p class="footer__text">Todos los derechos reservados &copy</p>
    </footer>

    </body>

</html>