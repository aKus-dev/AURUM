<?php


if(empty($_POST)) {
    header('Location: ../');
}


require '../../../clases/Chat.php';
require '../../../config/app.php';

$idChat = $_POST['idChat'];
$ciDocente = $_POST['ciDocente'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];


$sql = "SELECT ciUsuario FROM usuarios_chat where idChat = $idChat";
$result = $db->query($sql);

$existe = false;

?>

<!-- Envio los datos SIN VOLVER A INGRESARLO -->
<form action="../chat.php" method="POST">
    <input name="idChat" type="hidden" value="<?php echo $idChat ?>">
    <input name="ciDocente" type="hidden" value="<?php echo $ciDocente ?>">
</form>


<script src="/build/js/sendForm.js"></script>