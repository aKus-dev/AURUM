<?php

if(empty($_POST)) {
    header('Location: ../');
}

require '../../../clases/Chat.php';
require '../../../config/app.php';

$ciHost = $_POST['ciHost'];
$nombreHost = $_POST['nombreHost'];
$apellidoHost = $_POST['apellidoHost'];
$emailHost = $_POST['emailHost'];

$asignatura = $_POST['asignatura'];
$grupo = $_POST['grupo'];
$idSolicitud = $_POST['idSolicitud'];
$ciDocente = $_POST['ciDocente'];

$nombreDocente = $_POST['nombreDocente'];
$apellidoDocente = $_POST['apellidoDocente'];
$emailDocente = $_POST['emailDocente'];


date_default_timezone_set("America/Montevideo");
$fecha = date('Y-m-d'); // Antes estaba en Y-m-d

// Lo agrego al chat
$sql = "INSERT INTO chat (ciHost, nombreHost, apellidoHost, emailHost, ciDocente, nombreDocente, apellidoDocente,emailDocente, fecha, asignatura, grupo)
        VALUES ('$ciHost', '$nombreHost', '$apellidoHost', '$emailHost', '$ciDocente', '$nombreDocente', '$apellidoDocente', '$emailDocente', '$fecha', '$asignatura', '$grupo');
";

$db->query($sql);

// Elimino la solicitud
$db->query("DELETE FROM solicitud_chat WHERE id = $idSolicitud");


header('Location: ../solicitudes.php?success=true');
