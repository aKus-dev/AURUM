<?php
////////////////// CONEXION A LA BASE DE DATOS ////////////////////////////////////
require "../../../config/app.php";

$idChat = $_GET['idChat'];
$idUsuario = $_GET['idUsuario'];

$sql = "SELECT id, idUsuario, mensaje, nombreUsuario, apellidoUsuario FROM mensajes_chat WHERE idChat = $idChat";
$resultado = $db->query($sql);


///TABLA DONDE SE DESPLIEGAN LOS REGISTROS //////////////////////////////

while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
	$idMensaje = $row['id'];;
	$idUsuarioConsulta = $row['idUsuario'];;
	$mensaje = $row['mensaje'];
	$nombreUsuario = $row['nombreUsuario'];
	$apellidoUsuario = $row['apellidoUsuario'];
	
	if ($idUsuario == $idUsuarioConsulta) {
		echo "<div class='you' data-id=$idMensaje>";
			echo "<p> $mensaje </p>";
		echo '</div>';
	}

	if ($idUsuario != $idUsuarioConsulta) {
		echo "<div class='they' data-id=$idMensaje>";
			echo "<p> $mensaje </p>";
			echo "<span>$nombreUsuario $apellidoUsuario </span>";
		echo '</div>';
	}
}


