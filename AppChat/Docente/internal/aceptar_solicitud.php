<?php

if(empty($_POST)) {
    header('Location: ../');
}

require '../../../clases/Chat.php';
require '../../../config/app.php';

$idHost = $_POST['idHost'];
$nombreHost = $_POST['nombreHost'];
$apellidoHost = $_POST['apellidoHost'];
$asignatura = $_POST['asignatura'];
$grupo = $_POST['grupo'];
$idSolicitud = $_POST['idSolicitud'];
$idDocente = $_POST['idDocente'];
$nombreDocente = $_POST['nombreDocente'];
$apellidoDocente = $_POST['apellidoDocente'];


// Lo agrego al chat
$sql = "INSERT INTO chat (idHost, nombreHost, apellidoHost, idDocente, nombreDocente, apellidoDocente,  asignatura, grupo)
        VALUES ($idHost, '$nombreHost', '$apellidoHost', '$idDocente', '$nombreDocente', '$apellidoDocente', '$asignatura', '$grupo');
";

$db->query($sql);

// Elimino la solicitud
$db->query("DELETE FROM solicitud_chat WHERE id = $idSolicitud");


header('Location: ../solicitudes.php?success=true');
