<?php
////////////////// CONEXION A LA BASE DE DATOS ////////////////////////////////////
require "../../../config/app.php";
require "../../../clases/Chat.php";

$idChat = $_GET['idChat'];

/// VERIFICO QUE EL HOST ESTE ONLINE //////////////////////////////
$datosHost = Chat::getHost($idChat, $db);
$ciHost = $datosHost['ciHost'];
$nombreHost = $datosHost['nombre'];
$apellidoHost = $datosHost['apellido'];

$sql = "SELECT isOnline FROM usuarios_online WHERE idChat = $idChat AND ciUsuario = '$ciHost'";
$resultado = $db->query($sql);


while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
    $isOnline = $row['isOnline'];

    echo "<div class='user flex-alumnos-chat'>";
    echo " <i id='crown' class='fas fa-crown'></i>";
    echo "<p> $nombreHost  $apellidoHost </p>";

    if ($isOnline) {
        echo "<div class='online'>";
        echo " <i id='status-online' class='fas fa-circle'></i>";
        echo "</div>";
    }
    echo "</div>";
}


///////// VERIFICO QUE EL DOCENTE ESTE ONLINE
$datosDocente = Chat::getDocente($idChat, $db);
$ciDocente = $datosDocente['ciDocente'];
$nombreDocente = $datosDocente['nombre'];
$apellidoDocente = $datosDocente['apellido'];

$sql = "SELECT isOnline FROM usuarios_online WHERE idChat = $idChat AND ciUsuario = '$ciDocente'";
$resultado = $db->query($sql);

while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
    $isOnline = $row['isOnline'];

    echo "<div class='user flex-alumnos-chat'>";
    echo "<i  id='book' style='color: crimson' class='fas fa-book'></i>";
    echo "<p> $nombreDocente  $apellidoDocente </p>";

    if ($isOnline) {
        echo "<div class='online'>";
        echo " <i id='status-online' class='fas fa-circle'></i>";
        echo "</div>";
    }
    echo "</div>";
}


///////// VERIFICO QLOS USUARIOS ESTEN ONLINE
$sql = "SELECT ciUsuario FROM usuarios_chat WHERE idChat = $idChat";
$resultado = $db->query($sql);

///TABLA DONDE SE DESPLIEGAN LOS USUARIOS //////////////////////////////
while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
    $ciUsuario = $row['ciUsuario'];
    $datos = Chat::getUsuario($ciUsuario, $db);
    $nombreUsuario = $datos['nombre'];
    $apellidoUsuario = $datos['apellido'];
    $isOnline = false;


    $sql = "SELECT isOnline FROM usuarios_online WHERE idChat = $idChat AND ciUsuario = '$ciUsuario'";
    $result = $db->query($sql);

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $isOnline = $row['isOnline'];
    }

    echo "<div class='user flex-alumnos-chat'>";
    echo "<i id='student' class='fas fa-graduation-cap'></i>";
    echo "<p> $nombreUsuario  $apellidoUsuario </p>";

    if ($isOnline) {
        echo "<div class='online'>";
        echo " <i id='status-online' class='fas fa-circle'></i>";
        echo "</div>";
    }
    echo "</div>";
}
