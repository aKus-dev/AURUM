  
<?php
////////////////// CONEXION A LA BASE DE DATOS ////////////////////////////////////
require "../../../config/app.php";

$idUsuarioActual = $_GET['idUsuario'];
$idChat = $_GET['idChat'];
$idDocente = $_GET['idDocente'];

if (isset($_GET['idHost'])) {
	$idUsuarioActual = $_GET['idHost'];
}

if (isset($_GET['idUsuario'])) {

	$idUsuarioActual = $_GET['idUsuario'];
}



$sql = "SELECT id, idUsuario, mensaje, hora, nombreUsuario, apellidoUsuario FROM mensajes_chat WHERE idChat = $idChat";
$resultado = $db->query($sql);


///TABLA DONDE SE DESPLIEGAN LOS REGISTROS //////////////////////////////

while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
	$idUsuario = $row['idUsuario'];;
	$mensaje = $row['mensaje'];
	$hora = $row['hora'];
	$nombreUsuario = $row['nombreUsuario'];
	$apellidoUsuario = $row['apellidoUsuario'];


	if ($idUsuarioActual == $idUsuario) { // Caso sea el usuario actual
		echo "<div class='you'>";
		echo "<p>$mensaje</p>";
		echo "<span>$hora</span>";
		echo '</div>';
	}  else if ($idUsuarioActual != $idUsuario) { // Caso sea otro usuario
		echo "<div class='they'> ";
		echo "<p>$mensaje</p>";
		echo "<span class='data'>$nombreUsuario $apellidoUsuario <span>$hora</span>  </span>";
		echo '</div>';
	}
}