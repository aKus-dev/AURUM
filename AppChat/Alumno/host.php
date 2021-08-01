<?php

require '../../config/app.php';
require '../../clases/Chat.php';

isAuth_alumno();

$idChat = '';
$idHost = '';
$asignatura = '';
$datosChat = [];

// Si está el id, lo obtengo
if(isset($_POST['idChat'])) {
    $idChat = $_POST['idChat'];
    $datosChat = Chat::getDatos($idChat, $db);

    // Obtengo los datos que quiero de la tabla chat
    $idHost = $datosChat['idHost'];
    $asignatura = $datosChat['asignatura'];
}

if(isset($_POST['mensaje'])) {
    $mensaje = $_POST['mensaje'];
    $datosChat = Chat::enviarMensaje($idChat, $idHost,  $_SESSION['nombre'],  $_SESSION['apellido'], $mensaje , $db);
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

    <script>
        function ajax() {
            let req = new XMLHttpRequest();

            req.onreadystatechange = () => {
                if(req.readyState == 5 && req.status == 200) {
                    document.querySelector('.messages').innerHTML = req.responseText;
                }
            }

            req.open('GET', 'chat.php', true);
            req.send();
        }
    </script>
</head>
<body>
    <header class=" chat-header bg-main">
    <p class="title"><?php echo $asignatura ?></p>
    <i id="showMenu" class="fas fa-users"></i>
    </header>

    <main class="chat-container">
        <div class="users display-none">
            <div class="text-center">
                <h3>Otros chats activos</h3>

                <div class="chat-active">
                    <p class="materia">Matemática</p>
                    <p>Creado por: <span>Manuel Ugarte</span> </p>

                    <a href="#">
                        <i class=" fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="chat">
            <div class="messages">
                <div class="messages-container">
                    <?php
                    // Obtengo todos los mensajes de este chat
                    $sql = "SELECT idUsuario, mensaje, nombreUsuario, apellidoUsuario FROM mensajes_chat WHERE idChat = $idChat";
                    $result = $db->query($sql);

                    // Recorro los resultados y los almaceno en variables
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) :
                        $idUsuario = $row['idUsuario'];
                        $mensaje = $row['mensaje'];
                        $nombreUsuario = $row['nombreUsuario'];
                        $apellidoUsuario = $row['apellidoUsuario'];

                        // Dependiendo de si el mensaje es del alumno o de otros los muestro
                        if ($idUsuario === $idHost) :  ?>
                            <div class="you">
                                <p> <?php echo $mensaje ?> </p>
                            </div>
                        <?php endif; ?>

                        <?php if ($idUsuario !== $idHost) :  ?>
                            <div class="they">
                                <p> <?php echo $mensaje ?> </p>
                                <span>Enviado por: <?php echo $nombreUsuario . " " . $apellidoUsuario ?> </span>
                            </div>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
            </div>

            <form method="POST">
                <div id="sendMsg">
                    <input name="mensaje" type="text" placeholder="Mensaje...">
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

                <!--  Host -->
                <div class="user">
                    <i id="crown" class="fas fa-crown"></i>
                    <p>Agustín Vega</p>

                    <div class="online">
                        <i id="status-online" class="fas fa-circle"></i>
                    </div>
                </div>

                <!--  Usuario que se unió -->
                <div class="user">
                    <i id="student" class="fas fa-graduation-cap"></i>
                    <p>Roberto Cagaleri</p>

                    <div class="online">
                        <i id="status-online" class="fas fa-circle"></i>
                    </div>
                </div>
            </div>
        </div>
        <?php include './internal/menuMobile.php' ?>
    </main>


    <script src="/build/js/chatMenuMobile.js"></script>
    <script src="/build/js/chatScroll.js"></script>
    </body>

</html>