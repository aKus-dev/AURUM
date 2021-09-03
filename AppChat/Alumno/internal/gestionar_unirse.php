<?php

if(empty($_POST)) {
    header('Location: ../');
}

require '../../../clases/Chat.php';
require '../../../config/app.php';

$errorHorario = false;
$idChat = $_POST['idChat'];

// Obtengo el id real del docente para obtener sus horarios
$resultado = $db->query("SELECT ciDocente FROM chat WHERE id = $idChat");

while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
    $errorHorario =  Chat::getHorarioDocente($row['ciDocente'], $db);
}

if($errorHorario) {
    header('Location: ../unirse.php?errorHorario=true');
}

if(!$errorHorario) :
    $idChat = $_POST['idChat'];
    $ciUsuario = $_POST['ciUsuario'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    
    $sql = "SELECT ciUsuario FROM usuarios_chat where idChat = $idChat";
    $result = $db->query($sql);
    
    $existe = false;
    
    ?>
    
    <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) : ?>
    
        <?php if ($ciUsuario == $row['ciUsuario']) : ?>
            <?php $existe = true; ?>
            
            <!-- Envio los datos SIN VOLVER A INGRESARLO -->
            <form action="../chats/usuario.php" method="POST">
                <input name="idChat" type="hidden" value="<?php echo $idChat ?>">
                <input name="ciUsuario" type="hidden" value="<?php echo $ciUsuario ?>">
            </form>
    
        <?php endif; ?>
    
        <!-- Si ya existe me salgo del while -->
        <?php if ($existe) : ?>
            <?php break; ?>
        <?php endif; ?>
    
    <?php endwhile; ?>
    
    <?php if (!$existe) { ?>
        <?php
        $sql = "INSERT INTO usuarios_chat (idChat, ciUsuario, nombreUsuario, apellidoUsuario, email) VALUES ($idChat, '$ciUsuario', '$nombre', '$apellido', '$email')";;
        $stmt = $db->prepare($sql);
        ?>

        <?php if ($stmt->execute()) :  ?>
            <form action="../chats/usuario.php" method="POST">
                <input name="idChat" type="hidden" value="<?php echo $idChat ?>">
                <input name="ciUsuario" type="hidden" value="<?php echo $ciUsuario ?>">
            </form>
        <?php endif; ?>
    
    <?php } ?>
<?php endif; ?>



<script src="/build/js/sendForm.js"></script>