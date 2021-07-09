<?php

$idDocente = $_SESSION['id'];
$hayResultado_contestada = false;

// Datos alumnos
$nombre = '';
$apellido = '';


$grupos = [];
$grupos1 = false;
$gruposN = false;


// Selecciono las consultas pendientes
$sql = "SELECT id, idAlumno, titulo, fecha FROM consultas_docente WHERE estado = 'pendiente' AND idDocente = $idDocente ORDER BY id DESC";
$resultado = $db->query($sql);

?>

<?php while ($consulta = $resultado->fetch(PDO::FETCH_ASSOC)) :  $hayResultado_contestada = true ?>

    <?php

    // Obtengo los datos del alumno en base a su id sacado de la consultas al docente
    $idAlumno = $consulta['idAlumno'];
    $sqlAlumno = "SELECT nombre, apellido FROM alumno WHERE id = $idAlumno";
    $result = $db->query($sqlAlumno);

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $nombre = $row['nombre'];
        $apellido = $row['apellido'];
    }

    $sqlGrupos = "SELECT grupo FROM grupos_alumno WHERE idAlumno = $idAlumno";
    $resultadoGrupos = $db->query($sqlGrupos);

    while ($grupo = $resultadoGrupos->fetch(PDO::FETCH_ASSOC)) {
        $grupos[] = $grupo['grupo'];
    }

    if(sizeof($grupos) === 1) {
        $grupos1 = true;
    } else {
        $gruposN = true;
    }

    ?>

    <div class="consulta--container">

        <div class="date-style">
            <div class="line"></div>
            <p><?php echo $consulta['fecha'] ?> </p>
            <div class="line"></div>
        </div>


        <div class="titulo-consulta bg-main">
            <p> <?php echo $consulta['titulo']; ?> </p>
        </div>

        <div class="datos-consulta-flex">
            <div class="flex-consultas-datos">
                <h5>Id</h5>
                <p>#<?php echo $consulta['id']; ?></p>
            </div>

            <div class="flex-consultas-datos">
                <h5>Alumno</h5>
                <p><?php echo $nombre . " " . $apellido ?></p>
            </div>

            <div class="flex-consultas-datos">
                <?php  if($grupos1) {
                    echo "<h5>Grupo</h5>";
                }  else {  echo "<h5>Grupos</h5>"; }
                 ?>
                <p>
                   <?php
                    if($grupos1) {
                        echo $grupos[0];
                    } else {  
                        foreach($grupos as $grupo) {
                            echo $grupo . " ";
                        }
                    }

                    $grupos = [];

                    ?>
                </p>
            </div>

            <div class="flex-consultas-datos">
                <div id="btn-consulta">
                    <a <?php echo "href=./contestar.php?id=${consulta['id']}&n=$nombre&a=$apellido" ?> class="btn-consulta bg-main">
                        <p>Contestar</p>
                        <i class="fas fa-arrow-circle-right white"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>

<?php
endwhile;
?>

<?php if (!$hayResultado_contestada) : ?>
    <div class="no-consultas bg-main">
        <p>No tienes consultas recibidas</p>
    </div>
<?php endif; ?>