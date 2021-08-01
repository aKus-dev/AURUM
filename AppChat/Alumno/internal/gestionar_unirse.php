<?php
require '../../../clases/Chat.php';
require '../../../config/app.php';

$idChat = $_POST['idChat'];
$idUsuario = Chat::getIdAlumno($_POST['idUsuario'], $db);
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];

// VALIDAR QUE NO ESTE INGRESADO ANTES DE INGRESARLO

$sql = "SELECT * FROM usuarios_chat WHERE idChat = $idChat";
$result = $db->query($sql);

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

    if($idUsuario ==  $row['idUSuario']) {
        
    }
}

$sql = "INSERT INTO usuarios_chat VALUES ($idChat, $idUsuario, '$nombre', '$apellido')";;
$stmt = $db->prepare($sql);


if ($stmt->execute()) :  ?>
    <form action="../chats/usuario.php" method="POST">
        <input name="idChat" type="hidden" value="<?php echo $idChat ?>">
        <input name="idUsuario" type="hidden" value="<?php echo $idUsuario ?>">
    </form>
<?php endif; ?>

<script src="/build/js/sendForm.js"></script>