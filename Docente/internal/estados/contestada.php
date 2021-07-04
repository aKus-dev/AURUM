<?php

$idDocente = $_SESSION['id'];
$nombre = '';
$apellido = '';
$hayResultado_contestada = false;

// Variables para los grupos del alumno
$grupos = [];
$grupos1 = false;
$gruposN = false;


// Una vez tengo los datos del alimno, selecciono las consultas pendientes
$sql = "SELECT id, idAlumno, titulo, fecha FROM consultas_docente WHERE estado = 'contestada' AND idDocente = $idDocente ORDER BY id DESC";
$resultado = $db->query($sql);

?>

<?php while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) :

    $idAlumno = $row['idAlumno'];
    $hayResultado_contestada = true;
    // Obtengo los datos del alunno que coincidan con el estado de la consulta 
    $sqlAlumno = "SELECT DISTINCT nombre, apellido
            FROM alumno
            INNER JOIN consultas_docente as consulta
            ON consulta.estado = 'contestada' AND alumno.id = $idAlumno";
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

    <div class="consulta--container">
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
    <div class="no-consultas bg-main">
        <p>No tienes consultas contestadas</p>
    </div>
<?php endif; ?>