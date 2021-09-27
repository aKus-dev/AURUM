<?php

require '../../../config/app.php';
require '../../../clases/Administrador.php';
require '../../../clases/Sistema.php';

isAuth_admin();
$success = false;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $success = Administrador::altaAsignatura($_POST['asignatura'], $_POST['orientacion'], $_POST['grado'], $db);
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
    <title>AURUM: Asignaturas</title>
</head>
<body>

    <?php include '../../templates/header.php'; ?>

    <main class=" admin-form">
    <h2>¿Que desea hacer?</h2>

    <div class="flexRow buttons-container">
        <a href="#" class="btn-crud">Crear</a>
        <a href="./modify.php" class="btn-crud">Modificar</a>
        <a href="./delete.php" class="btn-crud">Eliminar</a>
    </div>
    </main>

    </div>

    <form method="POST">
        <!-- Contenedor de crear -->
        <div id="create-container" class="container-crud">

            <?php if ($success) : ?>
                <div class="text-center width100">
                    <p id="success" class="alert-success">Asignatura creada correctamente</p>
                </div>
            <?php endif; ?>


            <div class="text-center">
                <h2 class="font-size22">Crea una asignatura</h2>
            </div>

            <!-- Asignatura -->
            <div class="form__container-input">
                <div class="form__icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>

                <input name="asignatura" type="text" class="form__input" placeholder="Asignatura" required>
            </div>

            <!-- Orientación -->
            <div class="form__container-input">
                <select name="orientacion" class="form__select" required>
                    <option selected disabled>Orientación</option>
                    <?php Sistema::cargarOrientaciones($db); ?>
                </select>

            </div>


            <!-- Grado -->
            <div class="form__container-input">
                <select name="grado" class="form__select" required>
                    <option selected disabled>Grado de la asignatura</option>
                    <option value="1">1º Año</option>
                    <option value="2">2º Año</option>
                    <option value="3">3º Año</option>
                </select>
            </div>

            <input name="accion" value="crear_asignatura" type="hidden">

            <div class="button-center">
                <button class="btn-submit" type="submit">Registrar asignatura</button>
            </div>
        </div>
    </form>

    </div>

    <script src="../../../build/js/removeAlert.js"></script>
    </body>

</html>