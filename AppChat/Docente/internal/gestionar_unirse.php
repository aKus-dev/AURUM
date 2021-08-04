<?php


if(empty($_POST)) {
    header('Location: ../');
}


require '../../../clases/Chat.php';
require '../../../config/app.php';

$idChat = $_POST['idChat'];
$idUsuario = Chat::getIdDocente($_POST['idUsuario'], $db);
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];


$sql = "SELECT idUsuario FROM usuarios_chat where idChat = $idChat";
$result = $db->query($sql);

$existe = false;

?>

<!-- Envio los datos SIN VOLVER A INGRESARLO -->
<form action="../chat.php" method="POST">
    <input name="idChat" type="hidden" value="<?php echo $idChat ?>">
    <input name="idUsuario" type="hidden" value="<?php echo $idUsuario ?>">
</form>


<script src="/build/js/sendForm.js"></script>