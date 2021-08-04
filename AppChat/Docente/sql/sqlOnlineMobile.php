<?php
////////////////// CONEXION A LA BASE DE DATOS ////////////////////////////////////
require "../../../config/app.php";

$idChat = $_GET['idChat'];

$sql = "SELECT nombreHost, apellidoHost, isOnlineHost FROM chat WHERE id = $idChat";
$resultado = $db->query($sql);

///TABLA DONDE SE DESPLIEGAN LOS REGISTROS //////////////////////////////
while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
	$nombreHost = $row['nombreHost'];
	$apellidoHost = $row['apellidoHost'];
    $isOnlineHost = $row['isOnlineHost'];

    echo "<div class='user  flex-alumnos-chat'>";
        echo " <i id='crown' class='fas fa-crown'></i>";
        echo "<p> $nombreHost  $apellidoHost </p>";
        
        if($isOnlineHost) {
            echo "<div class='online'>";
                echo " <i id='status-online' class='fas fa-circle'></i>";
            echo "</div>";
        }
    echo "</div>";
}

$sql = "SELECT nombreDocente, apellidoDocente FROM chat WHERE id = $idChat";
$resultado = $db->query($sql);

///TABLA DONDE SE DESPLIEGAN LOS REGISTROS //////////////////////////////
while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
	$nombreDocente = $row['nombreDocente'];;
	$apellidoDocente = $row['apellidoDocente'];;

    echo "<div class='user flex-alumnos-chat'>";
        echo "<i style='color: crimson' id='book'  class='fas fa-book'></i>";
        echo "<p> $nombreDocente  $apellidoDocente </p>";
        
        echo "<div class='online'>";
            echo " <i id='status-online' class='fas fa-circle'></i>";
        echo "</div>";
    echo "</div>";
}


$sql = "SELECT nombreUsuario, apellidoUsuario, isOnline FROM usuarios_chat WHERE idChat = $idChat";
$resultado = $db->query($sql);

///TABLA DONDE SE DESPLIEGAN LOS USUARIOS //////////////////////////////
while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
	$nombreUsuario = $row['nombreUsuario'];
	$apellidoUsuario = $row['apellidoUsuario'];
    $isOnline = $row['isOnline'];

    echo "<div class='user  flex-alumnos-chat'>";
        echo "<i id='student' class='fas fa-graduation-cap'></i>";
        echo "<p> $nombreUsuario  $apellidoUsuario </p>";
        
        if($isOnline) {
            echo "<div class='online'>";
                echo " <i id='status-online' class='fas fa-circle'></i>";
            echo "</div>";
        }
    echo "</div>";
}





