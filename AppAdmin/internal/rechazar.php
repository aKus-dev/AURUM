<?php

require '../../config/app.php';

$id = $_POST['id'];
// Borro los datos viejos
$db->query("DELETE FROM pendiente WHERE idAlumno = $id");

header('Location: ./pendiente.php ');
