<?php

if (empty($_POST)) {
    header('Location: ../');
}

require '../../../clases/Chat.php';
require '../../../config/app.php';

$idChat = $_POST['idChat'];
$errorHorario = false;

// Obtengo el id real del docente para obtener sus horarios
$resultado = $db->query("SELECT idRealDocente FROM chat WHERE id = $idChat");

while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
    $errorHorario =  Chat::getHorarioDocente($row['idRealDocente'], $db);
}


?>

<!-- Si esta dentro de los horarios del docente lo mando al chat -->
<?php if (!$errorHorario) : ?>
    <form action="../chats/host.php" method="POST">
        <input name="idChat" type="hidden" value="<?php echo $idChat ?>">
    </form>
<?php endif; ?>

<?php

if($errorHorario) {
    header('Location: ../hostchats.php?errorHorario=true');
}

?>


<script src="/build/js/sendForm.js"></script>