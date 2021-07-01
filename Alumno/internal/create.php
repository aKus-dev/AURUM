<?php

require '../../config/app.php';
require '../../clases/Alumno.php';

isAuth_alumno();
$idAlumno = $_SESSION['id'];

$success = false;
$error = false;

$titulo = '';
$descripcion = '';

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
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../build/img/AURUM_color.svg">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link rel="stylesheet" href="/build/css/app.css"">
    <title>AURUM: Alumno</title>
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
            <a href="#">
                <i class="fas fa-arrow-circle-right white"></i>
            </a>
        </div>

        <p class="empezemos">¡Empezemos!</p>

        <form action="" class="form-consulta" method="POST">
            <div class="form-alumno-crear">
                <label for="titulo">Titulo</label>
                <input 
                required 
                name="titulo" 
                id="titulo" 
                type="text"
                placeholder="Titulo de la consulta"
                <?php if($error) : ?>
                        value="<?php if($error) echo "$titulo"; ?>"
                <?php endif; ?>
                >
            </div>

            <div class="form-alumno-crear">
                <label for="mensaje">Mensaje</label>
                <textarea  required name="descripcion" id="mensaje" placeholder="Descripción de la consulta"><?php if($error) {echo "$descripcion";  }; ?></textarea>
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