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
    "idAlumno" => $_POST['idAlumno'],
    "nombreAlumno" => $_POST['nombreAlumno'],
    "apellidoAlumno" => $_POST['apellidoAlumno']
];

// Obtengo los datos del docente
$datosDocente = Chat::datosDocente($_POST['asignatura'], $_POST['grupo'], $db);

// Verifico si el chat ya existe
$existe = Chat::revisarExistencia($datosDocente['idDocente'], $_POST['asignatura'], $db);

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

if (!empty($datosChat)) : $sendForm = true; ?>

    <form action="../chats/host.php" method="POST">
        <input name="idChat" type="hidden" value="<?php echo $datosChat['idChat'] ?>">
    </form>



<?php endif; ?>

<script src="/build/js/sendForm.js"></script>

<?php

