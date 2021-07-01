<?php


$id = $_SESSION['id'];
$nombre = $_SESSION['nombre'];
$apellido = $_SESSION['apellido'];
$hayResultado_contestada= false;

$sql = "SELECT id, titulo, fecha FROM consultas_alumno WHERE estado = 'recibida' AND idAlumno = $id";
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
        <p>No tienes consultas recibidas</p>
    </div>
<?php endif; ?>



