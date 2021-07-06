<?php

require '../../config/app.php';
isAuth_alumno();

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
                $sqlDocente = "SELECT DISTINCT id, nombre, apellido 
                FROM docente
                INNER JOIN grupos_docente as grupo
                ON docente.id = grupo.idDocente AND grupo.Grupo = '$grupo'";

                $result = $db->query($sqlDocente);

                // Lleno el array con todos los datos
                while ($datos = $result->fetch(PDO::FETCH_ASSOC)) {
                    $datosDocentes[] = $datos;
                }
            }

            // Recorro los datos del coente
            foreach ($datosDocentes as $docente) :
                $materias = [];

                // Selecciono las materias del docente
                $idDocente = $docente['id'];
                $sqlAsignaturas = "SELECT asignatura FROM asignaturas_docente WHERE idDocente = $idDocente";
                $resultadoAsignaturas = $db->query($sqlAsignaturas);

                // Guardo sus materias
                while ($rowAsignatura = $resultadoAsignaturas->fetch(PDO::FETCH_ASSOC)) {
                    $materias[] = $rowAsignatura['asignatura'];
                }

            ?>
            <!-- Muestro los datos -->
            <div class="m-5">
                <div class="titulo-consulta bg-main">
                    <p><?php echo $docente['nombre'] . " " . $docente['apellido']; ?></p>
                </div>

                <div class="datos-consulta-flex">
                    <div class="flex-consultas-datos">
                        <h5>Materias</h5>
                        <div class="materias-container">
                            <?php
                            foreach ($materias as $materia) {
                                echo "<p>$materia</p>";
                            }
                            ?>
                        </div>

                        <p></p>
                    </div>

                    
                </div>
            <?php
                $materias = [];
            endforeach;
            ?>
        </div>
        </div>
    </main>

    </div>

    <script src="/build/js/consultas.js"></script>
    </body>

</html>