  
<?php
////////////////// CONEXION A LA BASE DE DATOS ////////////////////////////////////
require "../../../config/app.php";


$ciUsuarioActual = '';
$idChat = $_GET['idChat'];
$ciHost = '';
$ciUsuario = '';

$ciDocente = '';

$result = $db->query("SELECT ciDocente FROM chat WHERE id = $idChat");

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
	$ciDocente = $row['ciDocente'];
}

if (isset($_GET['ciHost'])) {
	$ciUsuarioActual = $_GET['ciHost'];
}

if (isset($_GET['ciUsuario'])) {
	$ciUsuarioActual = $_GET['ciUsuario'];
}

$sql = "SELECT id, ciUsuario, mensaje, hora, nombreUsuario, apellidoUsuario FROM mensajes_chat WHERE idChat = $idChat";
$resultado = $db->query($sql);


///TABLA DONDE SE DESPLIEGAN LOS REGISTROS //////////////////////////////

while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
	$ciUsuario = $row['ciUsuario'];;
	$mensaje = $row['mensaje'];
	$hora = $row['hora'];
	$nombreUsuario = $row['nombreUsuario'];
	$apellidoUsuario = $row['apellidoUsuario'];

	if ($ciUsuarioActual == $ciUsuario) { // Caso sea el usuario actual
		echo "<div class='you'>";
		echo "<p>$mensaje</p>";
		echo "<span>$hora</span>";
		echo '</div>';
	} else  if ($ciUsuario == $ciDocente) { // Caso sea el profesor
		echo "<div class='teacher'>";
		echo "<p>$mensaje</p>";
		echo "<span class='data'>$nombreUsuario $apellidoUsuario <span>$hora</span>  </span>";
		echo '</div>';
	} else if ($ciUsuarioActual != $ciUsuario) { // Caso sea otro usuario
		echo "<div class='they'> ";
		echo "<p>$mensaje</p>";
		echo "<span class='data'>$nombreUsuario $apellidoUsuario <span>$hora</span>  </span>";
		echo '</div>';
	}
}