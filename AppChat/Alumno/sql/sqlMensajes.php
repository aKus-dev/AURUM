  
<?php
////////////////// CONEXION A LA BASE DE DATOS ////////////////////////////////////
require "../../../config/app.php";

$idUsuarioActual = '';
$idChat = $_GET['idChat'];
$idDocente = $_GET['idDocente'];

if (isset($_GET['idHost'])) {
	$idUsuarioActual = $_GET['idHost'];
}

if (isset($_GET['idUsuario'])) {

	$idUsuarioActual = $_GET['idUsuario'];
}



$sql = "SELECT id, idUsuario, mensaje, nombreUsuario, apellidoUsuario FROM mensajes_chat WHERE idChat = $idChat";
$resultado = $db->query($sql);


///TABLA DONDE SE DESPLIEGAN LOS REGISTROS //////////////////////////////

while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
	$idUsuario = $row['idUsuario'];;
	$mensaje = $row['mensaje'];
	$nombreUsuario = $row['nombreUsuario'];
	$apellidoUsuario = $row['apellidoUsuario'];

	if ($idUsuarioActual == $idUsuario) { // Caso sea el usuario actual
		echo "<div class='you'>";
		echo "<p>$mensaje</p>";
		echo '</div>';
	} else  if ($idUsuario == $idDocente) { // Caso sea el profesor
		echo "<div class='teacher'>";
		echo "<p>$mensaje</p>";
		echo "<span>$nombreUsuario $apellidoUsuario </span>";
		echo '</div>';
	} else if ($idUsuarioActual != $idUsuario) { // Caso sea otro usuario
		echo "<div class='they'> ";
		echo "<p>$mensaje</p>";
		echo "<span>$nombreUsuario $apellidoUsuario </span>";
		echo '</div>';
	}
}