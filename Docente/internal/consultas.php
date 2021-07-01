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
                <button class="btn-pendientes btn-pendientes--active" id="pendiente">Pendientes</button>
                <button class="btn-contestadas" id="contestada">Contestadas</button>
            </div>

        </div>

        <div id="pendiente-container">
            <div>
                <div class="titulo-consulta bg-main">
                    <p>Duda sobre como resolver el ejercicio 15</p>
                </div>

                <div class="datos-consulta-flex">
                    <div class="flex-consultas-datos">
                        <h5>Id</h5>
                        <p>#15</p>
                    </div>

                    <div class="flex-consultas-datos">
                        <h5>Alumno</h5>
                        <p>Mariano González</p>
                    </div>

                    <div class="flex-consultas-datos">
                        <h5>Fecha</h5>
                        <p>2021-05-25</p>
                    </div>

                    <div class="flex-consultas-datos">
                        <div id="btn-consulta">
                            <a href="#" class="btn-consulta bg-main">
                                <p>Contestar</p>
                                <i class="fas fa-arrow-circle-right white"></i>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div id="contestada-container" class="display-none"> 
            <div>
                <div class="titulo-consulta bg-main">
                    <p>Como puedo agregar un evento a un boton en JS</p>
                </div>

                <div class="datos-consulta-flex">
                    <div class="flex-consultas-datos">
                        <h5>Id</h5>
                        <p>#305</p>
                    </div>

                    <div class="flex-consultas-datos">
                        <h5>Alumno</h5>
                        <p>Fátima Moreno</p>
                    </div>

                    <div class="flex-consultas-datos">
                        <h5>Fecha</h5>
                        <p>2021-08-13</p>
                    </div>

                    <div class="flex-consultas-datos">
                        <div id="btn-consulta">
                            <a href="#" class="btn-consulta bg-main">
                                <p>Ver</p>
                                <i class="fas fa-arrow-circle-right white"></i>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="/build/js/consultas.js"></script>
    </body>

</html>