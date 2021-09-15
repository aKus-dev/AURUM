<?php
require '../../../config/app.php';
require '../../../clases/Administrador.php';
require '../../../clases/Sistema.php';

isAuth_admin();

$errorCedula = false;
$success = false;
$notFound =  false;

if ($_SERVER['REQUEST_METHOD']  === 'POST') {

    $resultado = Administrador::eliminarUsuario($_POST['ci'], $db);

    $resultado ? $success = true : $notFound = true;

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
    <title>AURUM: Eliminar Alumno</title>
</head>
<body>

    <?php include '../../templates/header.php'; ?>

    <main class=" admin-form">

    <h2>¿Que desea hacer?</h2>

    <div class="flexRow buttons-container">
        <a href="./create.php" class="btn-crud">Agregar</a>
        <a href="./modify.php" class="btn-crud">Modificar</a>
        <a href="#" class="btn-crud">Eliminar</a>
    </div>

    </main>


    <!-- Contenedor de eliminar -->
    <div id="remove-container" class="container-crud">

        <div class="text-center">

            <!-- Si la cedula no tiene 8 digitos  -->
            <?php if ($notFound) : ?>
                <p id="danger" class="alert-danger">La cédula no ha sido encontrada</p>
            <?php endif; ?>

            <!-- Se registro correctamente-->
            <?php if ($success) : ?>
                <p id="success" class="alert-success">Eliminado correctamente</p>
            <?php endif; ?>

        </div>

        <form action="" method="POST">
            <div class="text-center">
                <h2 class="font-size22">Cédula de alumno a eliminar</h2>
            </div>

            <!-- Cedula -->
            <div class="form__container-input">
                <div class="form__icon">
                    <i class="far fa-address-card"></i>
                </div>

                <input name="ci" type="text" class="form__input" placeholder="Cédula" maxlength="8" required>
            </div>

            <input name="accion" value="eliminar_alumno" type="hidden">


            <div class="button-center">
                <button class="btn-submit" type="submit">Eliminar alumno</button>
            </div>
        </form>
    </div>


    <script src="../../../build/js/removeAlert.js"></script>
    </body>

</html>