<?php ////////////////// CONEXION A LA BASE DE DATOS ////////////////////////////////////
require "../../../config/app.php";
require "../../../clases/Chat.php";

$idChat = $_GET['idChat'];
$idUsuario = $_GET['idUsuario'];
$ciDocente = $_GET['ciUsuario'];

$nombre = '';
$apellido = '';
$entro = false;

$sql = "SELECT nombre, apellido FROM usuario WHERE id = $idUsuario";
$resultado = $db->query($sql);

while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
    $nombre = $row['nombre'];
    $apellido = $row['apellido'];
}

$sql = "SELECT id, ciHost, ciDocente, asignatura FROM chat WHERE id != $idChat AND ciDocente = '$ciDocente'";

$resultado = $db->query($sql);


///TABLA DONDE SE DESPLIEGAN LOS REGISTROS //////////////////////////////

while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
    $entro = true;
	$id = $row['id'];;
	$asignatura = $row['asignatura'];
	$ciHost = $row['ciHost'];
    $ciDocente = $row['ciDocente'];
	
    $datosHost = Chat::getUsuario($ciHost, $db);
    $nombre = $datosHost['nombre'];
    $apellido = $datosHost['apellido'];
    $idUsuario = $datosHost['id'];

    echo "<form action='./internal/gestionar_unirse.php' method='POST'>";

        echo "<input type='hidden' name='idChat' value='$id'>";
        echo "<input type='hidden' name='idUsuario' value='$idUsuario'>";
        echo "<input type='hidden' name='ciDocente' value='$ciDocente'>";
        echo "<input type='hidden' name='nombre' value='$nombre'>";
        echo "<input type='hidden' name='apellido' value='$apellido'>";

        echo "<div class='chat-active'>";
            echo "<p class='materia'>$asignatura</p>";
            echo "<p>Creado por: <span>$nombre $apellido</span> </p>";

            echo "<button>";
            echo "    <i class='fas fa-arrow-right'></i>";
            echo "</button>";
        echo "</div>";


    echo "</form>";
	
}

if(!$entro) {
    echo "<div class='not-found'>";
        echo "<p>Aún no hay chats creados por otros usuarios</p>";
    echo "</div>";
}
