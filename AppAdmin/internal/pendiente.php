<?php

require '../../config/app.php';
require '../../clases/Sistema.php';
require '../../clases/Chat.php';

isAuth_admin();
Chat::offlineUsuario($_SESSION['CI'], $db);

$entro = false;
$id = $_SESSION['id'];


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
    <title>AURUM: Pendientes</title>
</head>
<body style=" overflow-x: hidden">

    <!-- Caso de que el chat NO tenga docente -->
    <?php if (!empty($_GET['success'])) : ?>
        <div class="text-center width100">
            <p id="success" class="alert-success">El chat ha sido aceptado con éxito</p>
        </div>
    <?php endif; ?>

    <div class="">
        <?php include '../templates/header.php' ?>

        <div class="chat-materia">
            <div class="">
                <?php

                $result = $db->query("SELECT * FROM pendiente");

                ?>

                <div class="pendiente-container">
                    <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) : ?>
                        <?php $entro = true; ?>

                        <div class="pendiente">

                            <?php
                            $idAlumno = $row['idAlumno'];
                            $grupos = '';
                            ?>

                            <div class="data">
                                <h3><?php echo $row['nombre'] . " " . $row['apellido'] ?></h3>

                                <div>
                                    <p>CI: <span><?php echo $row['CI'] ?> </span> </p>
                                    <p>Correo: <span><?php echo $row['email'] ?> </span> </p>

                                    <?php $resultado = $db->query("SELECT * FROM grupos_pendiente WHERE idAlumno = $idAlumno"); ?>
                                    <?php while ($datos = $resultado->fetch(PDO::FETCH_ASSOC)) : ?>
                                        <?php $grupos .= $datos['grupo'] . " " ?>
                                    <?php endwhile; ?>

                                    <p>Grupo(s): <span><?php echo $grupos ?></span> </p>
                                </div>


                                <div class="form-pendiente">
                                    <form action="aceptar">
                                        <input type="hidden" value="<?php echo $row['idAlumno'] ?>">
                                        <button>
                                            <i class="fas fa-check-square green"></i>
                                        </button>
                                    </form>

                                    <form action="rechazar">
                                        <input type="hidden" value="<?php echo $row['idAlumno'] ?>">
                                        <button>
                                            <i class="fas fa-window-close red"></i>
                                        </button>
                                    </form>
                                </div>

                            </div>

                            <div class="violet-filter"></div>
                        </div>



                    <?php endwhile; ?>
                </div>

                <?php if (!$entro) : ?>
                    <div class="no-consultas bg-main text-center">
                        <p>No hay alumnos pendientes de aprobación</p>
                    </div>
                <?php endif; ?>



                <?php $i = 0 // Por las dudas lo vuelvo a igualar a 0 
                ?>
            </div>

            </body>

            <script src="/build/js/removeAlert.js"></script>

</html>