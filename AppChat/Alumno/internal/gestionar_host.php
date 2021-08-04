<?php

if(empty($_POST)) {
    header('Location: ../');
}

require '../../../clases/Chat.php';
require '../../../config/app.php';

$idChat = $_POST['idChat'];
$idUsuario = Chat::getIdAlumno($_POST['idUsuario'], $db);
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];

?>

<form action="../chats/host.php" method="POST">
    <input name="idChat" type="hidden" value="<?php echo $idChat ?>">
</form>


<script src="/build/js/sendForm.js"></script>

