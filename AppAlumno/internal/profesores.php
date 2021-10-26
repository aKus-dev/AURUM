<?php

require '../../config/app.php';
require '../../clases/Chat.php';
require '../../clases/Docente.php';

isAuth_alumno();
Chat::offlineUsuario($_SESSION['CI'], $db);


$entro = false;

$idAlumnno = $_SESSION['id'];
$grupos = [];

// Selecciono los grupos del alumno
$sql = "SELECT grupo FROM grupos_alumno WHERE idAlumno = $idAlumnno";
$resultado = $db->query($sql);

// Lleno el array con los grupos
while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
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
    <title>AURUM: Profesores</title>
</head>
<body>
    <div class=" alumno-container">
    <?php include '../templates/header.html' ?>

    <main class=" consulta-container">
        <h2>Tus profesores</h2>

        <div class="consulta--container">


            <!-- Selecciono los datos del profesor por cada grupo que tenga el alumno -->
            <?php foreach ($grupos as $grupo) {

                $datosDocentes =  [];

                // Selecciono los datos del profesor que sean del grupo del alumno
                $sqlDocente = "SELECT DISTINCT id, CI, nombre, apellido 
                FROM usuario
                INNER JOIN grupos_docente as grupo
                ON usuario.id = grupo.idDocente AND grupo.Grupo = '$grupo' AND usuario.tipo = 'docente'";

                $result = $db->query($sqlDocente);

                // Lleno el array con todos los datos
                while ($datos = $result->fetch(PDO::FETCH_ASSOC)) {
                    $datosDocentes[] = $datos;
                }

            }

            // Recorro los datos del coente
            foreach ($datosDocentes as $docente) :
                $materias = [];
                $entro = true;

                // Selecciono las materias del docente
                $idDocente = $docente['id'];
                $ciDocente = $docente['CI'];
                $sqlAsignaturas = "SELECT asignatura FROM asignaturas_docente WHERE idDocente = $idDocente";
                $resultadoAsignaturas = $db->query($sqlAsignaturas);

                // Guardo sus materias
                while ($rowAsignatura = $resultadoAsignaturas->fetch(PDO::FETCH_ASSOC)) {
                    $materias[] = $rowAsignatura['asignatura'];
                }

                $horariosDocente = Docente::getHorarios($ciDocente, $db);

                

            ?>
                <!-- Muestro los datos -->
                <div class="m-5">
                    <div class="titulo-consulta bg-main">
                        <p><?php echo $docente['nombre'] . " " . $docente['apellido']; ?></p>
                    </div>

                    <div class="datos-consulta-flex">
                        <div class="flex-consultas-datos">
                            <h5 id="materias">Materias</h5>
                            <div class="materias-container">
                                <?php
                                foreach ($materias as $materia) {
                                    $materia = $materia;
                                    echo "<p>$materia</p>";
                                }
                                ?>
                            </div>


                            <h5 id="horarios" style="margin-top: 1.5rem">Horarios</h5>
                            <?php
                                if($horariosDocente) {
                                    $diaMinimo = $horariosDocente['diaMinimo'];
                                    $diaMaximo = $horariosDocente['diaMaximo'];
                                    $horaMinima = $horariosDocente['horaMinima'];
                                    $horaMaxima = $horariosDocente['horaMaxima'];

                                    $horaMinima .= 'hs';
                                    $horaMaxima .= 'hs';

                                    echo "<p>De  $diaMinimo a $diaMaximo entre $horaMinima y $horaMaxima<p>";
                                } else {
                                    echo "<p>Aún no ha registrado sus horarios</p>";
                                }
                            ?>



                            <p></p>
                        </div>


                    </div>
                <?php
                $materias = [];
            endforeach;
                ?>

                <?php if (!$entro) :  ?>
                    <div class="no-consultas bg-main">
                        <p id="not-found">Aún no tienes profesores en tu grupo</p>
                    </div>
                <?php endif ?>
                </div>
        </div>
    </main>

    </div>


    <script src="/languages/alumno/profesores.js"></script>
    <script src="/languages/alumno/header.js"></script>
    </body>

</html>