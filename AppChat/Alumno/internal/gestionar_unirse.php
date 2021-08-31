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
$email = $_POST['email'];


$sql = "SELECT idUsuario FROM usuarios_chat where idChat = $idChat";
$result = $db->query($sql);

$existe = false;

?>

<?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) : ?>

    <?php if ($idUsuario == $row['idUsuario']) : ?>
        <?php $existe = true; ?>

        <!-- Envio los datos SIN VOLVER A INGRESARLO -->
        <form action="../chats/usuario.php" method="POST">
            <input name="idChat" type="hidden" value="<?php echo $idChat ?>">
            <input name="idUsuario" type="hidden" value="<?php echo $idUsuario ?>">
        </form>

    <?php endif; ?>

    <!-- Si ya existe me salgo del while -->
    <?php if ($existe) : ?>
        <?php break; ?>
    <?php endif; ?>

<?php endwhile; ?>

<?php if (!$existe) { ?>
    <?php
    $sql = "INSERT INTO usuarios_chat (idChat, idUsuario, nombreUsuario, apellidoUsuario, email) VALUES ($idChat, $idUsuario, '$nombre', '$apellido', '$email')";;
    $stmt = $db->prepare($sql);
    ?>

    <?php if ($stmt->execute()) :  ?>
        <form action="../chats/usuario.php" method="POST">
            <input name="idChat" type="hidden" value="<?php echo $idChat ?>">
            <input name="idUsuario" type="hidden" value="<?php echo $idUsuario ?>">
        </form>
    <?php endif; ?>

<?php } ?>


<script src="/build/js/sendForm.js"></script>