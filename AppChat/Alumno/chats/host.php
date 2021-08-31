<?php

require '../../../config/app.php';
require '../../../clases/Chat.php';
require '../../../clases/Sistema.php';

isAuth_alumno();

$idChat = '';
$idHost = '';
$idDocente = '';
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

// Lo paso a online
Chat::onlineAlumno($_SESSION['id'], $idChat, 'host', $db);

$idDocente = $datosChat['idDocente'];

$grupo = Sistema::formatearGrupos([$datosChat['grupo']],  $db);

if (isset($_POST['mensaje'])) {
    $mensaje = $_POST['mensaje'];
    $datosChat = Chat::enviarMensaje($idChat, $idHost,  $_SESSION['nombre'],  $_SESSION['apellido'], $mensaje, $db);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg" href="/build/img/AURUM_color.svg">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link rel="stylesheet" href="/build/css/app.css"">
    <title>AURUM: Chat</title>

    <script src=" https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js">
    </script>

    <script type="text/javascript">
        function tiempoReal() {
            idChat = <?php echo $idChat ?>;
            idHost = <?php echo $idHost ?>;
            idDocente = <?php echo $idDocente ?>;

            var mensajes = $.ajax({
                url: `../sql/sqlMensajes.php?idChat=${idChat}&idHost=${idHost}&idDocente=${idDocente}`,
                dataType: 'text',
                async: false
            }).responseText;

            // Obtiene los usuarios del chat
            var usuarios = $.ajax({
                url: `../sql/sqlOnline.php?idChat=${idChat}`,
                dataType: 'text',
                async: false
            }).responseText;

            // Obtiene los usuarios del chat para la version mobile
            var usuariosMobile = $.ajax({
                url: `../sql/sqlOnlineMobile.php?idChat=${idChat}`,
                dataType: 'text',
                async: false
            }).responseText;

            document.querySelector(".messages-container").innerHTML = mensajes;
            document.querySelector("#usuarios").innerHTML = usuarios;
            document.querySelector("#usuarios_mobile").innerHTML = usuariosMobile;
        }

        setInterval(tiempoReal, 300);
    </script>
</head>

<body>
    <header class=" chat-header bg-main">
        <a href="../hostchats.php">
         <i id="back" class="fas fa-arrow-left"></i>
        </a>

        <p class="title"><?php echo $asignatura . " (" . $grupo[0] . ")" ?></p>
        <i id="showMenu" class="fas fa-users"></i>
    </header>

    <main class="chat-container">
        <div class="users display-none">
            <div class="text-center">
                <div class="pt-3">
                    <h3>Finaliza el chat</h3>

                    <form action="../mail/finalizar.php" id="finalizar-chat" method="post">
                        <p>Al dar en finalizar, se enviara un resumen del chat a los correos de los usuarios, ¡Asegurate de que todas tus dudas se hayan aclarado!</p>
                        <input type="hidden" name="idChat" value="<?php echo $idChat ?>">

                        <button class="bg-main">Finalizar</button>
                    </form>
                </div>

            </div>
        </div>

        <div class="chat">
            <div class="messages">
                <div class="messages-container">

                </div>
            </div>

            <form method="POST">
                <div id="sendMsg">
                    <input id="msg" name="mensaje" type="text" placeholder="Mensaje..." maxlength="500">
                    <input name="idChat" type="hidden" value="<?php echo $idChat ?>">

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
        <?php include '../internal/menuMobileHost.php' ?>
    </main>


    <script src="/build/js/chatMenuMobile.js"></script>
    <script src="/build/js/chatScroll.js"></script>
</body>

</html>