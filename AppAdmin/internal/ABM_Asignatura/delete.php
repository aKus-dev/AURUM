<?php
require '../../../config/app.php';
require '../../../clases/Administrador.php';
require '../../../clases/Sistema.php';

$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(!empty($_POST['asignatura'])) {
        $success = Administrador::bajaAsignatura($_POST['asignatura'], $db);
    }
}


isAuth_admin();
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
        <a href="./create.php" class="btn-crud">Crear</a>
        <a href="./modify.php" class="btn-crud">Modificar</a>
        <a href="#" class="btn-crud">Eliminar</a>
    </div>
    </main>

    </div>


    <form method="POST">
        <!-- Contenedor de eliminar -->
        <div id="remove-container" class="container-crud">

            <?php if ($success) : ?>
                <div class="text-center width100">
                    <p id="success" class="alert-success">Asignatura eliminada correctamente</p>
                </div>
            <?php endif; ?>


            <div class="text-center">
                <h2 class="font-size22">Elimina una asignatura</h2>
            </div>

            <!-- Asignatura -->
            <div class="form__container-input">
                <select name="asignatura" class="form__select">
                    <option selected disabled>Seleccione la asignatura</option>
                    <?php Sistema::cargarAsignaturas($db); ?>
                </select>
            </div>


            <input name="accion" value="eliminar_asignatura" type="hidden">

            <div class="button-center">
                <button class="btn-submit" type="submit">Eliminar asignatura</button>
            </div>
    </form>


    </div>

    <script src="../../../build/js/removeAlert.js"></script>
    </body>

</html>