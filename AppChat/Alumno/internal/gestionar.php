<?php


if(empty($_POST)) {
    header('Location: ../');
}

require '../../../clases/Chat.php';
require '../../../config/app.php';

$datosChat = '';
$idChat = '';

$grupo = $_POST['grupo'];


$datosAlumno = [
    "ciHost" => $_POST['ciHost'],
    "nombreAlumno" => $_POST['nombreAlumno'],
    "apellidoAlumno" => $_POST['apellidoAlumno'],
    "emailAlumno" => $_POST['emailAlumno']
];

// Obtengo los datos del docente
$datosDocente = Chat::datosDocente($_POST['asignatura'], $_POST['grupo'], $db);
;
// Verifico si el chat ya existe
$existe = Chat::revisarExistencia($datosDocente['ciDocente'], $_POST['asignatura'], $grupo, $datosAlumno, $db);

if (!$existe) {
    // Creo el chat
    $datosChat = Chat::crearChat($datosAlumno, $datosDocente, $grupo, $db);

    $sql = "SELECT id FROM chat ORDER BY id DESC LIMIT 1";
    $result = $db->query($sql);

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $idChat = $row['id'];
    }

    $datosChat['idChat'] = $idChat;

}

// Se creo el chat 
if (!empty($datosChat)) {
    header('Location: ../hostchats.php?success=true');
}








