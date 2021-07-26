<?php

require '../../config/app.php';

$asignatura = '';
$grupo = '';

if (!empty($_POST)) {
    $asignatura = $_POST['asignatura'];
    $grupo = $_POST['grupo'];

    // Obtengo los datos del profesor de esa asignatura en el grupo
    $sql  = "SELECT DISTINCT id, nombre, apellido
             FROM docente
             INNER JOIN grupos_docente
             ON grupos_docente.idDocente = docente.id AND grupo = '$grupo'
             INNER JOIN asignaturas_docente as asignaturas
             ON docente.id = asignaturas.idDocente AND asignatura = '$asignatura'";

    $result = $db->query($sql);
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        // Obtener datos del docente
    }

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
                    <div class="you">
                        <p>Hola!! Tengo una duda sobre javascript </p>
                        <span>Enviado por: Agustin Vega</span>
                    </div>

                    <div class="they">
                        <p>Hola! Si, decime </p>
                        <span>Enviado por: Leonardo López</span>
                    </div>
                </div>
            </div>

            <form method="GET">
                <div id="sendMsg">
                    <input name="mensaje" type="text" placeholder="Mensaje...">

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
      </body>
</html>