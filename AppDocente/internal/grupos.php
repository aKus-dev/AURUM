<?php

require '../../config/app.php';
require '../../clases/Chat.php';

isAuth_docente();
Chat::offlineDocente($_SESSION['CI'], $db);



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
    <title>AURUM: Grupos</title>
</head>
<body>
    <div class=" alumno-container">
    <?php include '../templates/header.html' ?>

    <main class=" consulta-container">
        <h2>Tus grupos</h2>


        <div class="consulta--container">
            <div class="alumno-clase">
                <div class="datos-contaner">

                    <?php
                    $grupos =  [];
                    $id = $_SESSION['id'];

                    // Selecciono sus grupos
                    $sql = "SELECT grupo FROM grupos_docente WHERE idDocente = $id";
                    $resultadoGrupos = $db->query($sql);

                    while ($grupo = $resultadoGrupos->fetch(PDO::FETCH_ASSOC)) {
                        $grupos[] = $grupo['grupo'];
                    }


                    ?>
                        <?php foreach ($grupos as $grupo) : ?>

                            <p class="grupos-docente-list bg-main"><?php echo $grupo ?></p>
      

                            <div class="datos-compas">
                            <?php
                            
                            // En base a los grupos que está, selecciono sus compañeros
                            $sql = "SELECT DISTINCT nombre, apellido, imagen 
                            FROM usuario 
                            INNER JOIN grupos_docente as docenteGrupos 
                            ON docenteGrupos.grupo = '$grupo'
                            INNER JOIN grupos_alumno as alumnoGrupo
                            ON usuario.id = alumnoGrupo.idAlumno AND alumnoGrupo.grupo = '$grupo'
                            AND usuario.tipo = 'alumno'";

                            $resultado = $db->query($sql);
                            while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                $nombre = $row['nombre'];
                                $apellido = $row['apellido'];
                                $imagen = $row['imagen'];

                                echo "<div>";
                                echo "<span class='bg-main'>$nombre $apellido</span>";
                                echo "<div>";
                                echo "<img src='$imagen'>";
                                echo "</div>";
                                echo "</div>";
                            }

                            ?>
                         </div>

                        <?php endforeach; ?>
                    
                </div>
            </div>
      
    </main>

    </div>


    <script src="/build/js/consultas.js"></script>
    </body>

</html>