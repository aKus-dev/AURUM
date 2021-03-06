<?php ////////////////// CONEXION A LA BASE DE DATOS ////////////////////////////////////
require "../../../config/app.php";
require "../../../clases/Chat.php";

$idChat = $_GET['idChat'];
$ciUsuario = $_GET['ciUsuario'];
$grupos = explode(",", $_GET['grupos']); // Obtengo uno a uno sus grupos

$nombre = '';
$apellido = '';
$entro = false;

// Selecciono nombre y apellido del usuario
$sql = "SELECT nombre, apellido FROM usuario WHERE CI = '$ciUsuario'";
$resultado = $db->query($sql);

while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
    $nombre = $row['nombre'];
    $apellido = $row['apellido'];
}

// Recorro los grupos y selecciono los chats solo de esos grupos
foreach ($grupos as $grupo) {
    $sql = "SELECT id, asignatura, ciHost, emailHost FROM chat WHERE id != $idChat AND grupo = '$grupo'";
    $resultado = $db->query($sql);

    while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
        $entro = true;
        $id = $row['id'];;
        $asignatura = $row['asignatura'];
        $ciHost = $row['ciHost'];
        $emailHost = $row['emailHost'];

        $datosHost = Chat::getUsuario($ciHost, $db);
        $nombre = $datosHost['nombre'];
        $apellido = $datosHost['apellido'];
        $idUsuario = $datosHost['id'];

        echo "<form action='../internal/gestionar_unirse.php' method='POST'>";

        echo "<input type='hidden' name='idChat' value='$id'>";
        echo "<input type='hidden' name='ciUsuario' value='$ciHost'>";
        echo "<input type='hidden' name='nombre' value='$nombre'>";
        echo "<input type='hidden' name='apellido' value='$apellido'>";
        echo "<input type='hidden' name='email' value='$emailHost'>";

        echo "<div class='chat-active'>";
        echo "<p class='materia'>$asignatura</p>";
        echo "<p>Creado por: <span>$nombre $apellido</span> </p>";

        echo "<button>";
        echo "    <i class='fas fa-arrow-right'></i>";
        echo "</button>";
        echo "</div>";


        echo "</form>";
    }
}


if (!$entro) {
    echo "<div class='not-found'>";
    echo "<p>A??n no hay chats creados por otros usuarios</p>";
    echo "</div>";
}
