<?php

require '../../config/app.php';
require '../../clases/Sistema.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos, crear el chat y pasar el id del chat
    header("Location: ./chat.php");
}

isAuth_alumno();


$id = $_SESSION['id'];
$grupos = [];
$gruposFormateados = [];

$sql = "SELECT grupo FROM grupos_alumno WHERE idAlumno = $id ORDER BY grupo ASC";
$result = $db->query($sql);
$actual = 'filter-violet sky';

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $grupos[] = $row['grupo'];
}


$gruposCopia = $grupos;
$gruposFormateados = Sistema::formatearGrupos($gruposCopia, $db);

$i = 0;

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
    <title>AURUM: Empezemos</title>
</head>
<body style="overflow: auto">
    <div class=" alumno-container">
    <?php include '../../AppAlumno/templates/header.html' ?>

    <!-- Caso de que el chat NO tenga docente -->
    <?php if (!empty($_GET['empty'])) : ?>
        <div class="text-center width100 absolute">
            <p id="danger" class="alert-danger">La materia seleccionada aún no tiene un docente asignado</p>
        </div>
    <?php endif; ?>

     <!-- Caso de que ya este creado -->
     <?php if (!empty($_GET['created'])) : ?>
        <div class="text-center width100 absolute">
            <p id="danger" class="alert-danger">El chat ya está creado. Puedes unirte yendo a la sección anterior</p>
        </div>
    <?php endif; ?>

    <div class="chat-materia">
        <div class="materias-container-chat">
            <?php foreach ($grupos as $grupo) :
                // Me quedo solo con la parte entera del grupo
                $grado = substr($grupo, 0, -2);


                $sql = "SELECT id, asignatura FROM chat";
                $result = $db->query($sql);

            ?>

                <p class="grupos-docente-list bg-main title-grupo-chat">
                    <?php
                    echo $gruposFormateados[$i];
                    $i++;
                    ?>
                </p>

                <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) : ?>
                    <?php $asignatura = $row['asignatura']; ?>
                    <?php $actual === 'filter-violet sky' ? $actual = 'filter-darkviolet wave' : $actual = 'filter-violet sky' ?>

                    <form action="./internal/gestionar_unirse.php" method="POST">
                        <div class="materia <?php echo $actual ?>">
                            <h3><?php echo $asignatura ?></h3>
                            <button>Unirse</button>


                            <?php
                            $idAlumno = $_SESSION['id'];
                            $nombreAlumno = $_SESSION['nombre'];
                            $apellidoAlumno = $_SESSION['apellido'];
                            ?>

                            <input type="hidden" name="idChat" value="<?php echo $row['id'] ?>">
                            <input type="hidden" name="idUsuario" value="<?php echo $_SESSION['id'] ?>">
                            <input type="hidden" name="nombre" value="<?php echo $_SESSION['nombre'] ?>">
                            <input type="hidden" name="apellido" value="<?php echo  $_SESSION['apellido']?>">

                            <div class="<?php echo $actual ?>"></div>
                        </div>
                    </form>

                <?php endwhile; ?>
            <?php endforeach; ?>

            <?php $i = 0 // Por las dudas lo vuelvo a igualar a 0 
            ?>
        </div>

        </body>

        <script src="/build/js/removeAlert.js"></script>
</html>