<?php 

if(empty($_POST)) {
    header('Location: ../');
}

require '../../../clases/Chat.php';
require '../../../config/app.php';

$idSolicitud = $_POST['idSolicitud'];
$db->query("DELETE FROM solicitud_chat WHERE id = $idSolicitud"); 

header('Location: ../solicitudes.php');

