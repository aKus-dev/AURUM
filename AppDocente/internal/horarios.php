<?php

require '../../config/app.php';
require '../../clases/Docente.php';
require '../../clases/Chat.php';

isAuth_docente();
Chat::offlineUsuario($_SESSION['CI'], $db);


$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dias = []; // Almacenara los dias (incluye los dias que NO selecciono)
    $diasLlenados = []; // Almacena unciamente los dias que selecciono

    // Guardo los horarios
    $horaMinima = $_POST['desde'];
    $horaMaxima = $_POST['hasta'];


    // Obtengo los dias y los almaceno en un array
    $dias[] = $_POST['lunes'];
    $dias[] = $_POST['martes'];
    $dias[] = $_POST['miercoles'];
    $dias[] = $_POST['jueves'];
    $dias[] = $_POST['viernes'];
    $dias[] = $_POST['sabado'];
    $dias[] = $_POST['domingo'];

    // Me quedo solo con los días llenados y no con los strings vacios
    foreach ($dias as $dia) {
        if ($dia !== '') {
            $diasLlenados[] = $dia;
        }
    }

    // Obtengo el dia minimo y maximo
    $diaMinimo = min($diasLlenados);
    $diaMaximo = max($diasLlenados);

    $idDocente = $_SESSION['id'];
    $ciDocente = $_SESSION['CI'];

    // diaMinimo, diaMaximo, horaMinima, horaMaxima

    $sql = "UPDATE horarios SET dia_minimo = $diaMinimo WHERE ciDocente = '$ciDocente'";
    $db->query($sql);

    $sql = "UPDATE horarios SET dia_maximo = $diaMaximo WHERE ciDocente = '$ciDocente'";
    $db->query($sql);

    $sql = "UPDATE horarios SET hora_minima = '$horaMinima' WHERE ciDocente = '$ciDocente'";
    $db->query($sql);

    $sql = "UPDATE horarios SET hora_maxima = '$horaMaxima' WHERE ciDocente = '$ciDocente'";
    $db->query($sql);

    $sql = "UPDATE horarios SET registro_horarios = true WHERE ciDocente = '$ciDocente'";
    $db->query($sql);


    header('Location: /AppDocente/index.php?horario=true');
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
    <title>AURUM: Horarios</title>
</head>
<body>
    <div class=" alumno-container">
    <?php include '../templates/header.html' ?>

    <main class="horarios-container">
        <h2 id="RegistraH">Registra tus horarios</h2>

        <form action="" method="POST" class="form-horarios">
            <p id="selectDays" class="text-violet">Selecciona los días en los cuales atenderás consultas</p>

            <div class="day-container">
                <label class="day" id="lunes">Lunes</label>
                <label class="day" id="martes">Martes</label>
                <label class="day" id="miercoles">Miércoles</label>
                <label class="day" id="jueves">Jueves</label>
                <label class="day" id="viernes">Viernes</label>
                <label class="day" id="sabado">Sábado</label>
                <label class="day" id="domingo">Domingo</label>

                <input id="input-lunes" name="lunes" type="hidden">
                <input id="input-martes" name="martes" type="hidden">
                <input id="input-miercoles" name="miercoles" type="hidden">
                <input id="input-jueves" name="jueves" type="hidden">
                <input id="input-viernes" name="viernes" type="hidden">
                <input id="input-sabado" name="sabado" type="hidden">
                <input id="input-domingo" name="domingo" type="hidden">

            </div>

            <p id="SeleHorario" class="text-violet">Selecciona el horario en el cual atenderas consultas</p>
            <div class="horas-container">
                <div>
                    <label id="desde" for="desde">Desde</label>
                    <input name="desde" id="desde" type="time" required>
                </div>

                <div>
                    <label id="hasta" for="hasta">Hasta</label>
                    <input name="hasta" id="hasta" type="time" required>
                </div>
            </div>

            <div class="btn-submit-consulta">
                <button  id="envHorario" type="submit" class="bg-main">Enviar horario</button>
            </div>
        </form>
    </main>
    <script src="/languages/docente/horarios.js"></script>
    <script src="/build/js/horario.js"></script>
    <script src="/build/js/removeAlert.js"></script>
    <script src="/languages/docente/header.js"></script>
    </body>

</html>