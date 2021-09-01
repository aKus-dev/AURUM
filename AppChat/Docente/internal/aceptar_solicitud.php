<?php

if(empty($_POST)) {
    header('Location: ../');
}

require '../../../clases/Chat.php';
require '../../../config/app.php';

$idHost = $_POST['idHost'];
$nombreHost = $_POST['nombreHost'];
$apellidoHost = $_POST['apellidoHost'];
$emailHost = $_POST['emailHost'];

$asignatura = $_POST['asignatura'];
$grupo = $_POST['grupo'];
$idSolicitud = $_POST['idSolicitud'];
$idDocente = $_POST['idDocente'];

$nombreDocente = $_POST['nombreDocente'];
$apellidoDocente = $_POST['apellidoDocente'];
$emailDocente = $_POST['emailDocente'];



// Lo agrego al chat
$sql = "INSERT INTO chat (idHost, nombreHost, apellidoHost, emailHost, idDocente, nombreDocente, apellidoDocente,emailDocente, asignatura, grupo)
        VALUES ($idHost, '$nombreHost', '$apellidoHost', '$emailHost', '$idDocente', '$nombreDocente', '$apellidoDocente', '$emailDocente', '$asignatura', '$grupo');
";

$db->query($sql);

// Elimino la solicitud
$db->query("DELETE FROM solicitud_chat WHERE id = $idSolicitud");


header('Location: ../solicitudes.php?success=true');
