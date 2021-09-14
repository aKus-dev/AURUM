<?php
require '../../config/app.php';
require '../../clases/Alumno.php';
require '../../clases/Sistema.php';

$encontrado = true;
// TEMPORAL
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

   /*  Sistema::revisarAdministrador($usuario, $password, $db);
    Sistema::revisarDocente($usuario, $password, $db); */
    /* $encontrado = Sistema::revisarAlumno($usuario, $password, $db); */
    $encontrado = Sistema::revisarUsuario($usuario, $password, $db);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../../build/img/AURUM_color.svg">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link rel="stylesheet" href="../../build/css/app.css"">
    <title>AURUM: Inicia sesión</title>
</head>

<body>

  <main class=" form bg-main">
    <div class="text-center">
        <a href="../../index.html">
            <img class="form__logo" src="../../build/img/AURUM.svg" alt="">
        </a>
    </div>
    </main>

    <div class="form__form-container pb-50">
        <form action="" method="POST" class="width100">

            <div class="text-center">
                <?php if (!$encontrado) : ?>
                    <p id="danger" class="alert-danger">Usuario no encontrado</p>
                <?php endif; ?>
                <h2 class="form__heading">Inicia sesión</h2>
            </div>

            <!-- Contenedor icono + input -->
            <div class="form__container-input">
                <div class="form__icon">
                    <i class="far fa-user"></i>
                </div>

                <input name="usuario" type="text" class="form__input" placeholder="Cédula o usuario" required maxlength="8">

            </div>

            <!-- Contenedor icono + input -->
            <div class="form__container-input">
                <div class="form__icon">
                    <i class="fas fa-unlock-alt"></i>
                </div>

                <input name="password" type="password" class="form__input" placeholder="Tu contraseña" required minlength="6">

            </div>

            <div class="button-center">
                <button class="btn-submit" type="submit">Iniciar sesión</button>
            </div>

        </form>
    </div>

    <script src="/build/js/formAnimation.js"></script>
    <script src="/build/js/removeAlert.js"></script>
    </body>

</html>