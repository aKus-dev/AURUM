<?php

require '../../config/app.php';
isAuth_alumno();

$id = $_SESSION['id'];
$grupos = [];

$sql = "SELECT grupo FROM grupos_alumno WHERE idAlumno = $id";
$result = $db->query($sql);
$actual = 'filter-violet sky';


while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $grupos[] = $row['grupo'];
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
    <title>AURUM: Chat</title>
</head>
<body>
    <div class=" alumno-container">
    <?php include '../../Alumno/templates/header.html' ?>

    <div class="chat-materia">

        <div class="materias-container-chat">

            <?php foreach ($grupos as $grupo) :
                // Me quedo solo con la parte entera del grupo
                $grado = substr($grupo, 0, -2);

                $sql = "SELECT nombre FROM asignaturas WHERE grado = $grado";
                $result = $db->query($sql);


                while ($row = $result->fetch(PDO::FETCH_ASSOC)) : ?>
                    <?php $nombre = utf8_encode($row['nombre']); ?>
                    <?php $actual === 'filter-violet sky' ? $actual = 'filter-darkviolet wave' : $actual = 'filter-violet sky' ?>

                    <div class="materia <?php echo $actual ?>">
                        <h3><?php echo $nombre ?></h3>
                        <a href="#">Crear</a>

                        <div class="<?php echo $actual ?>"></div>
                    </div>

                   

                <?php endwhile; ?>
            <?php endforeach; ?>

        </div>

        </body>
</html>