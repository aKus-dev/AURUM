<?php


$id = $_SESSION['id'];
$nombre = $_SESSION['nombre'];
$apellido = $_SESSION['apellido'];
$hayResultado_realizada = false;

$grupos = [];
$grupo1 = false;
$grupoN = false;

$nombreDocente = '';
$apellidoDocente = '';

$sql = "SELECT id, idDocente, titulo, fecha FROM consultas WHERE estado = 'realizada' AND idAlumno = $id ORDER BY id DESC";
$resultado = $db->query($sql);


$sqlGrupo = "SELECT grupo FROM grupos_alumno WHERE idAlumno = $id";
$resultadoGrupos = $db->query($sqlGrupo);

while ($dato = $resultadoGrupos->fetch(PDO::FETCH_ASSOC)) {
    $grupos[] = $dato['grupo'];
}


if (sizeof($grupos) === 1) {
    $grupo1 = true;
} else {
    $grupoN = true;
}

?>

<?php while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) :  $hayResultado_realizada = true ?>

    <?php

    $idDocente = $row['idDocente'];

    // Selecciono el nombre del profesores
    $sqlDocente = "SELECT nombre,apellido FROM usuario WHERE id = $idDocente AND usuario.tipo = 'docente'";
    $resultadoDocente = $db->query($sqlDocente);

    while ($datosDocente = $resultadoDocente->fetch(PDO::FETCH_ASSOC)) {
        $nombreDocente = $datosDocente['nombre'];
        $apellidoDocente = $datosDocente['apellido'];
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
                <h5>Para</h5>
                <p><?php echo $nombreDocente . " " . $apellidoDocente ?></p>
            </div>

            <div class="flex-consultas-datos">
                <h5>De</h5>
                <p><?php echo $nombre . " " . $apellido ?></p>
            </div>

            <div class="flex-consultas-datos">
                <div id="btn-consulta">
                    <form action="./ver_realizada.php" method="POST">
                        <input type="hidden" value="<?php echo  $row['id'] ?>" name="id">
                        <input type="hidden" value="<?php echo $nombre ?>" name="nombre_alumno">
                        <input type="hidden" value="<?php echo $apellido ?>" name="apellido_alumno">

                        <button type="submit" class="btn-consulta bg-main">Ver <i class="fas fa-arrow-circle-right white"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endwhile; ?>

<?php if (!$hayResultado_realizada) : ?>
    <div class="no-consultas bg-main">
        <p>No tienes consultas realizadas</p>
    </div>
<?php endif; ?>