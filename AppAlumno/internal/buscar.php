<?php

require '../../config/app.php';
require '../../clases/Sistema.php';
require '../../clases/Chat.php';

isAuth_alumno();
Chat::offlineAlumno($_SESSION['id'], $db);

$encontro = null;
$resultados = false;
$mostrarAlerta = false;

if (!empty($_GET)) {
    $consulta = $_GET['consulta'];

    if ($consulta) {
        $resultados = Sistema::buscarConsulta($consulta, $db);

        if (!$resultados) {
            $mostrarAlerta = true;
        }
    }
}

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
    <title>AURUM: Buscar</title>
</head>
<body>
    <div class=" alumno-container">
    <?php include '../templates/header.html' ?>

    <main class=" consulta-container">
        <h2>Busca por titulo</h2>
        <p class="guia-buscar">Te recomendamos buscar por palabras clave</p>

        <div>
            <form>
                <div class="buscar-container">
                    <input id="buscar_consulta" name="consulta" type="text" placeholder="Escribe el titulo de una consulta" required="required">

                    <div class="icon-container">
                        <button>
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>

            <?php if ($resultados != false) : ?>

                <?php
                foreach ($resultados as $resultado) :
                    $id = $resultado['id'];
                    $nombreAlumno = $resultado['nombreAlumno'];
                    $apellidoAlumno = $resultado['apellidoAlumno'];
                    $nombreDocente = $resultado['nombreDocente'];
                    $apellidoDocente = $resultado['apellidoDocente'];
                    $titulo = $resultado['titulo'];
                    $descripcion = $resultado['descripcion'];
                    $respuesta = $resultado['respuesta'];
                    $fecha = $resultado['fecha'];
                ?>

                    <div class="consulta--container">
                        <div class="date-style">
                            <div class="line"></div>
                            <p><?php echo $fecha ?> </p>
                            <div class="line"></div>
                        </div>

                        <div class="titulo-consulta bg-main">
                            <p> <?php echo $titulo; ?> </p>
                        </div>

                        <div class="datos-consulta-flex">
                            <div class="flex-consultas-datos">
                                <h5>Id</h5>
                                <p>#<?php echo $id; ?></p>
                            </div>

                            <div class="flex-consultas-datos">
                                <h5>De</h5>
                                <p><?php echo $nombreAlumno . " " . $apellidoAlumno ?></p>
                            </div>


                            <div class="flex-consultas-datos">
                                <h5>Para</h5>
                                <p><?php echo $nombreDocente . " " . $apellidoDocente ?></p>
                            </div>


                            <div class="flex-consultas-datos">
                                <div id="btn-consulta">
                                    <form action="./ver_buscada.php" method="POST">
                                        <input type="hidden" value="<?php echo $id ?>" name="id">
                                        <input type="hidden" value="<?php echo $nombreAlumno ?>" name="nombre_alumno">
                                        <input type="hidden" value="<?php echo $apellidoAlumno ?>" name="apellido_alumno">
                                        <input type="hidden" value="<?php echo $nombreDocente ?>" name="nombre_docente">
                                        <input type="hidden" value="<?php echo $apellidoDocente ?>" name="apellido_docente">

                                        <button type="submit" class="btn-consulta bg-main">Ver <i class="fas fa-arrow-circle-right white"></i></button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            <?php endif; ?>


            <?php if ($mostrarAlerta) :  ?>
                <div class="no-consultas bg-main">
                    <p>No se han encontrado resultados</p>
                </div>
            <?php endif ?>
        </div>
    </main>

    </div>

    <script src="/build/js/consultas.js"></script>
    </body>

</html>