<?php

require '../../config/app.php';
require '../../clases/Chat.php';
require '../../clases/Sistema.php';

isAuth_docente();

$idChat = '';
$idUsuario = $_POST['idUsuario'];
$asignatura = '';
$datosChat = [];

// Si está el id, lo obtengo
if (isset($_POST['idChat'])) {
    $idChat = $_POST['idChat'];
    $datosChat = Chat::getDatos($idChat, $db);

    // Obtengo los datos que quiero de la tabla chat
    $idHost = $datosChat['idHost'];
    $asignatura = $datosChat['asignatura'];
}

// Pongo al docente como online
Chat::onlineDocente($_SESSION['id'], $idChat, $db);

$idDocente = $datosChat['idDocente'];

$grupo = Sistema::formatearGrupos([$datosChat['grupo']],  $db);

if (isset($_POST['mensaje'])) {
    $mensaje = $_POST['mensaje'];
    $datosChat = Chat::enviarMensaje($idChat, $idUsuario,  $_SESSION['nombre'],  $_SESSION['apellido'], $mensaje, $db);
}

$idUsuarioReal = $_SESSION['id'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg" href="/build/img/AURUM_color.svg">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link rel="stylesheet" href="/build/css/app.css">
    <title>AURUM: Chat</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <script type="text/javascript">
        function tiempoReal() {
            idChat = <?php echo $idChat ?>;
            idUsuario = <?php echo $idUsuario ?>;
            idDocente = <?php echo $idDocente ?>;
            idUsuarioReal = <?php echo $idUsuarioReal ?>;

            // Obtiene los mensajes del usuario
            let mensajes = $.ajax({
                url: `./sql/sqlMensajes.php?idChat=${idChat}&idUsuario=${idUsuario}&idDocente=${idDocente}`,
                dataType: 'text',
                async: false
            }).responseText;

            // Obtiene los usuarios del chat
            let usuarios = $.ajax({
                url: `./sql/sqlOnline.php?idChat=${idChat}`,
                dataType: 'text',
                async: false
            }).responseText;

            // Obtiene los usuarios del chat para la version mobile
            let usuariosMobile = $.ajax({
                url: `./sql/sqlOnlineMobile.php?idChat=${idChat}`,
                dataType: 'text',
                async: false
            }).responseText;

            let chatsActivos = $.ajax({
                url: `./sql/sqlChatsActivos.php?idChat=${idChat}&idUsuario=${idUsuarioReal}&idDocente=${idDocente}`,
                dataType: 'text',
                async: false
            }).responseText;

            document.querySelector(".messages-container").innerHTML = mensajes;
            document.querySelector("#usuarios").innerHTML = usuarios;
            document.querySelector("#usuarios_mobile").innerHTML = usuariosMobile;
            document.querySelector("#chats-activos").innerHTML = chatsActivos;
            document.querySelector("#chats-mobile-insert").innerHTML = chatsActivos; 
        }


        setInterval(tiempoReal, 300);
    </script>
</head>

<body>
    <header class=" chat-header bg-main">
        <a href="./chats.php">
            <i id="back" class="fas fa-arrow-left"></i>
        </a>
        <p class="title"><?php echo $asignatura . " [" . $grupo[0] . "]" ?></p>
        <i id="showMenu" class="fas fa-users"></i>
    </header>

    <main class="chat-container">
        <div class="users display-none">
            <div class="text-center">
                <h3>Otros chats activos</h3>

                <div id="chats-activos"> </div>
            </div>
        </div>

        <div class="chat">
            <div class="messages">
                <div class="messages-container">

                </div>
            </div>

            <form method="POST">
                <div id="sendMsg">
                    <input id="msg" name="mensaje" type="text" placeholder="Mensaje...">
                    <input name="idChat" type="hidden" value="<?php echo $idChat ?>">
                    <input name="idUsuario" type="hidden" value="<?php echo $idUsuario ?>">

                    <button class="bg-main">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </form>
        </div>

        <div class="users display-none">
            <div class="text-center">
                <h3>Usuarios</h3>

                <div id="usuarios">

                </div>

            </div>
        </div>

        <?php include './internal/menuMobile.php' ?>
    </main>


    <script src="/build/js/chatMenuMobile.js"></script>
    <script src="/build/js/chatScroll.js"></script>
</body>

</html>