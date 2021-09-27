<?php
require '../../config/app.php';
require '../../clases/Administrador.php';
require '../../clases/Sistema.php';

isAuth_admin();

$nombre = '';
$apellido = '';
$hayResultado_contestada = false;

// Variables para los grupos del alumno
$grupos = [];
$grupos1 = false;
$gruposN = false;


// Una vez tengo los datos del alimno, selecciono las consultas pendientes
$sql = "SELECT id, idAlumno, titulo, fecha FROM consultas WHERE estado = 'contestada' OR estado = 'recibida' ORDER BY id DESC";
$resultado = $db->query($sql);

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
    <title>AURUM: Agenda</title>
</head>
<body>

    <?php include '../templates/header.php'; ?>

    <main class="consultas-admin">
    <?php while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) :

        $idAlumno = $row['idAlumno'];
        $hayResultado_contestada = true;
        // Obtengo los datos del alunno que coincidan con el estado de la consulta 
        $sqlAlumno = "SELECT DISTINCT u.nombre, u.apellido
        FROM usuario u
        INNER JOIN consultas as c
        ON c.estado = 'contestada' OR c.estado = 'recibida' AND u.id = $idAlumno AND u.tipo = 'alumno'";
        $result = $db->query($sqlAlumno);

        
        while ($datos = $result->fetch(PDO::FETCH_ASSOC)) {
            $nombre = $datos['nombre'];
            $apellido = $datos['apellido'];
        }

   

        // Obtengo los grupos del alumno
        $sqlGrupos = "SELECT grupo FROM grupos_alumno WHERE idAlumno = $idAlumno";
        $resultadoGrupos = $db->query($sqlGrupos);

        while ($grupo = $resultadoGrupos->fetch(PDO::FETCH_ASSOC)) {
            $grupos[] = $grupo['grupo'];
        }

        // Me fijo si tiene más de un grupo
        if (sizeof($grupos) === 1) {
            $grupos1 = true;
        } else {
            $gruposN = true;
        }



    ?>

<div class="consulta">
        <div class="date-style">
            <div class="line"></div>
            <p><?php echo $row['fecha'] ?> </p>
            <div class="line"></div>
        </div>

        <div class="titulo-consulta bg-main">
            <p> <?php echo $row['titulo']; ?> </p>
        </div>

        <div class="datos-consulta-flex">
            <div class="flex-consultas-datos">
                <h5>Id</h5>
                <p>#<?php echo $row['id']; ?></p>
            </div>

            <div class="flex-consultas-datos">
                <h5>Alumno</h5>
                <p><?php echo $nombre . " " . $apellido ?></p>
            </div>

            <div class="flex-consultas-datos">
                <?php if ($grupos1) {
                    echo "<h5>Grupo</h5>";
                } else {
                    echo "<h5>Grupos</h5>";
                }
                ?>
                <p>
                    <?php
                    if ($grupos1) {
                        echo $grupos[0];
                    } else {
                        foreach ($grupos as $grupo) {
                            echo $grupo . " ";
                        }
                    }

                    $grupos = [];

                    ?>
            </div>

            <div class="flex-consultas-datos">
                <div id="btn-consulta">
                    <a <?php echo "href=./ver.php?id=${row['id']}&n=$nombre&a=$apellido" ?> class="btn-consulta bg-main">
                        <p>Ver</p>
                        <i class="fas fa-arrow-circle-right white"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>

    <?php endwhile; ?>

    <?php if (!$hayResultado_contestada) : ?>
        <div class="no-consultas bg-main text-center">
            <p>No se han realizado consultas</p>
        </div>
    <?php endif; ?>
    </main>

    </body>

</html>