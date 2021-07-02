<?php

$idDocente = $_SESSION['id'];
$hayResultado_contestada= false;

// Datos alumnos
$nombre = '';
$apellido = '';

// Selecciono las consultas pendientes
$sql = "SELECT id, idAlumno, titulo, fecha FROM consultas_docente WHERE estado = 'pendiente' AND idDocente = $idDocente";
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

?>
    
  <div>
    <div class="titulo-consulta bg-main">
        <p>  <?php echo $consulta['titulo']; ?>  </p>
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
            <h5>Fecha</h5>
            <p><?php echo $consulta['fecha']; ?></p>
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

<?php if(!$hayResultado_contestada) : ?>
    <div class="no-consultas bg-main">
        <p>No tienes consultas pendientes</p>
    </div>
<?php endif; ?>



