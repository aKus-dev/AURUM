<?php

require '../../config/app.php';
require '../../clases/Alumno.php';
require '../../clases/Sistema.php';

isAuth_alumno();

$idAlumno = $_SESSION['id'];

$success = false;
$errorHorario = false;
$error = false;
$datos  = [];

$titulo = '';
$descripcion = '';
$diaMinimo = '';
$diaMaximo = '';
$horaMinima = '';
$horaMaxima = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($_POST['profesor'] === "null") {
        $error = true;
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
    } else {
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $idDocente = $_POST['profesor'];

        $success = Alumno::realizarConsulta($idAlumno, $idDocente, $titulo, $descripcion, $db);

        if (!$success) {
            $errorHorario = true;
            $datos = Sistema::errorHorario($idDocente, $db);
        }
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="/build/img/AURUM_color.svg">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link rel="stylesheet" href="/build/css/app.css"">
    <title>AURUM: Enviar consulta</title>
</head>
<body>


    <div class=" alumno-container">
    <?php include '../templates/header.html' ?>

    <div class="crear-consulta align-center">
        <!-- Se falto ingresar docente-->
        <?php if ($error) : ?>
            <div class="text-center width100">
                <p id="danger" class="alert-danger">Debes seleccionar un docente</p>
            </div>
        <?php endif; ?>

        <!-- Se registro correctamente-->
        <?php if ($errorHorario) : ?>

            <?php
            $diaMinimo = $datos['diaMinimo'];
            $diaMaximo = $datos['diaMaximo'];
            $horaMinima = $datos['horaMinima'];
            $horaMaxima = $datos['horaMaxima'];
            ?>


            <!-- NO ha registrado horarios -->
            <?php if (empty($diaMinimo) || empty($diaMaximo) ||  empty($horaMinima) ||  empty($horaMaxima)) : ?>
                <div class="text-center width100">
                    <p id="danger" class="alert-danger">El docente aún no ha registrado sus horarios, intentalo más tarde</p>
                </div>
            <?php endif; ?>

            <!-- Caso que haya registrado horarios, pero no se encuentra en el horario valido del docente -->
            <?php if (!empty($diaMinimo) && !empty($diaMaximo) &&  !empty($horaMinima) &&  !empty($horaMaxima)) : ?>
                <div class="text-center width100">
                    <p id="danger" class="alert-danger">El docente solo acepta consultas de
                        <?php echo $diaMinimo ?> a <?php echo $diaMaximo ?> entre <?php echo $horaMinima ?> y
                        <?php echo $horaMaxima ?> horas
                    </p>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <!-- Se registro correctamente-->
        <?php if ($success) : ?>
            <div class="text-center width100">
                <p id="success" class="alert-success">Consulta enviada correctamente</p>
            </div>
        <?php endif; ?>

        <h1>Crear consulta</h1>

        <div class="text-center">
            <p>Antes de crearla... ¡revisa si alguien ya preguntó lo mismo!</p>
        </div>

        <div class="todas-consultas bg-main">
            <p>Ver todas las consultas</p>
            <a href="./buscar.php">
                <i class="fas fa-arrow-circle-right white"></i>
            </a>
        </div>

        <p class="empezemos">¡Empezemos!</p>

        <form action="" class="form-consulta" method="POST">
            <div class="form-alumno-crear">
                <label for="titulo">Titulo</label>
                <input required name="titulo" id="titulo" type="text" placeholder="Titulo de la consulta" <?php if ($error) : ?> value="<?php if ($error) echo "$titulo"; ?>" <?php endif; ?>>
            </div>

            <div class="form-alumno-crear">
                <label for="mensaje">Mensaje</label>
                <textarea required name="descripcion" id="mensaje" placeholder="Descripción de la consulta"><?php if ($error) {
                                                                                                                echo "$descripcion";
                                                                                                            }; ?></textarea>
            </div>

            <div>
                <select name="profesor" class="select-profesor" required>
                    <option selected value="null">Seleccione un profesor</option>
                    <?php Alumno::cargarProfesores($db); ?>
                </select>
            </div>

            <div class="btn-submit-consulta">
                <button type="submit" class="bg-main">Enviar consulta</button>
            </div>
        </form>
    </div>
    </div>

    <script src="/build/js/removeAlert.js"></script>
    </body>

</html>