<?php

$id = $_SESSION['id'];
$nombre = $_SESSION['nombre'];
$apellido = $_SESSION['apellido'];
$hayResultado_pendiente = false;

$nombreDocente = '';
$apellidoDocente = '';

$grupos = [];
$grupo1 = false;
$grupoN = false;


// Selecciono los datos de la consulta
$sql = "SELECT id, idDocente, titulo, fecha FROM consultas_alumno WHERE estado = 'contestada' AND idAlumno = $id ORDER BY id DESC";
$resultado = $db->query($sql);

// Selecciono los grupos del alimno
$sqlGrupo = "SELECT grupo FROM grupos_alumno WHERE idAlumno = $id";
$resultadoGrupos = $db->query($sqlGrupo);

// Recorro los grupos del alumno
while ($dato = $resultadoGrupos->fetch(PDO::FETCH_ASSOC)) {
    $grupos[] = $dato['grupo'];
}

// Evaluo si tiene 1 o más grupos
if (sizeof($grupos) === 1) {
    $grupo1 = true;
} else {
    $grupoN = true;
}

?>

<?php while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) :  $hayResultado_pendiente = true ?>

<?php

$idDocente = $row['idDocente'];

// Selecciono el nombre del profesores
$sqlDocente = "SELECT nombre,apellido FROM docente WHERE id = $idDocente";
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
                <p><?php  echo $nombre . " " . $apellido ?></p>
            </div>

            <div class="flex-consultas-datos">
                <div id="btn-consulta">
                    <a <?php echo "href=./ver_contestada.php?id=${row['id']}&n=$nombre&a=$apellido&nd=$nombreDocente&ad=$apellidoDocente" ?> class="btn-consulta bg-main">
                        <p>Ver</p>
                        <i class="fas fa-arrow-circle-right white"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>

<?php endwhile; ?>

<?php if (!$hayResultado_pendiente) : ?>
    <div class="no-consultas bg-main">
        <p>No tienes consultas contestadas</p>
    </div>
<?php endif; ?>