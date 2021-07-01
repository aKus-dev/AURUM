<?php

$idDocente = $_SESSION['id'];
$nombre = '';
$apellido = '';
$hayResultado_contestada= false;

// Consulta para obtener los datos del alumno
$sql = "SELECT DISTINCT nombre, apellido
FROM alumno
INNER JOIN consultas_docente as consulta
ON consulta.estado = 'pendiente' AND alumno.id = consulta.idAlumno";
$result = $db->query($sql);

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $nombre = $row['nombre'];
    $apellido = $row['apellido'];
}

// Una vez tengo los datos del alimno, selecciono las consultas pendientes
$sql = "SELECT id, titulo, fecha FROM consultas_docente WHERE estado = 'contestada' AND idDocente = $idDocente";
$resultado = $db->query($sql);

?>

<?php while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) :  $hayResultado_contestada = true ?>
    
  <div>
    <div class="titulo-consulta bg-main">
        <p>  <?php echo $row['titulo']; ?>  </p>
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
            <h5>Fecha</h5>
            <p><?php echo $row['fecha']; ?></p>
        </div>

        <div class="flex-consultas-datos">
            <div id="btn-consulta">
                <a href="#" class="btn-consulta bg-main">
                    <p>Ver</p>
                    <i class="fas fa-arrow-circle-right white"></i>
                </a>
            </div>

        </div>
    </div>
</div>

<?php endwhile; ?>

<?php if(!$hayResultado_contestada) : ?>
    <div class="no-consultas bg-main">
        <p>No tienes consultas contestadas</p>
    </div>
<?php endif; ?>



