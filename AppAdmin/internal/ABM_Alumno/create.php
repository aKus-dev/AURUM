<?php
require '../../../config/app.php';
require '../../../clases/Administrador.php';
require '../../../clases/Sistema.php';

isAuth_admin();

$existeCI = false;
$existeMail = false;
$success = false; // Pasa a true cuando todo haya salido correcto
$rellenar = false; // Pasa a true cuando haya que volver a rellenar el formulario (caso de error)
$errorCedula = false;


// Revisar si se ha enviado en metodo POST
// Comprobar que los datos hayan sido enviado en POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $cedula = $_POST['ci'];

    if (strlen($cedula) < 8) {
        $errorCedula = true;
        $rellenar = true;
        $nombre = $_POST['nombre'];
        $cedula = $_POST['ci'];
        $apellido = $_POST['apellido'];
        $email = $_POST['email'];
    } else {
        // Comprobar si la cedula y mail ya existe
        $existeCI = Sistema::revisarCedula($_POST['ci'], $db);
        $existeMail = Sistema::revisarMail($_POST['ci'], $db);

        // En caso de que NO exista, lo ingresamos al sistema
        if (!$existeCI && !$existeMail) {
            $success = Administrador::altaUsuario($_POST,'alumno',$db);
        } else {
            // En caso de que exista, relleno los campos nuevamente para que cambie algo
            $rellenar = true;
            $nombre = $_POST['nombre'];
            $cedula = $_POST['ci'];
            $apellido = $_POST['apellido'];
            $email = $_POST['email'];
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
    <title>AURUM: Alta Alumno</title>
</head>
<body>

    <?php include '../../templates/header.php'; ?>

    <main class=" admin-form">

    <h2>??Que desea hacer?</h2>

    <div class="flexRow buttons-container">
        <a href="#" class="btn-crud">Agregar</a>
        <a href="./modify.php" class="btn-crud">Modificar</a>
        <a href="./delete.php" class="btn-crud">Eliminar</a>
    </div>

    </main>

    </div>
    <!-- Contenedor de crear -->
    <div id="create-container" class="container-crud container-crud--alumno ">

        <div class="text-center">
            <h2 class="font-size22">Ingrese un alumno</h2>
        </div>

        <div class="text-center">
            <?php

            if ($existeCI && $existeMail) {
                echo '<p id="danger" class="alert-danger">La c??dula y el correo ya est??n registrados</p>';
            } else if ($existeCI) {
                echo '<p id="danger" class="alert-danger">La c??dula ya est?? registrada</p>';
            } else if ($existeMail) {
                echo '<p id="danger" class="alert-danger">El correo ya est?? registrado</p>';
            }
            ?>

            <!-- Si la cedula no tiene 8 digitos  -->
            <?php if ($errorCedula) : ?>
                <p id="danger" class="alert-danger">La c??dula debe tener 8 digitos</p>
            <?php endif; ?>

            <!-- Se registro correctamente-->
            <?php if ($success) : ?>
                <p id="success" class="alert-success">Registrado correctamente</p>
            <?php endif; ?>

        </div>

        <form action="" method="POST" class="width100">


            <!-- Contenedor icono + input -->
            <div class="input-tablet">
                <div class="form__container-input">
                    <div class="form__icon">
                        <i class="far fa-user"></i>
                    </div>

                    <input name="nombre" minlength="3" type="text" class="form__input" placeholder="Nombre" required <?php if ($rellenar) : ?> value="<?php if ($rellenar) echo "$nombre"; ?>" <?php endif; ?>>

                </div>

                <div class="form__container-input">
                    <div class="form__icon">
                        <i class="far fa-user"></i>
                    </div>

                    <input name="apellido" minlength="3" type="text" class="form__input" placeholder="Apellido" required <?php if ($rellenar) : ?> value="<?php if ($rellenar) echo "$apellido"; ?>" <?php endif; ?>>

                </div>
            </div>


            <!-- Contenedor icono + input -->
            <div class="input-tablet">
                <div class="form__container-input">
                    <div class="form__icon">
                        <i class="fas fa-unlock-alt"></i>
                    </div>

                    <input id="password" name="contrasena" type="password" class="form__input" placeholder="Contrase??a" required minlength="6">

                </div>

                <div class="form__container-input">
                    <div class="form__icon">
                        <i class="fas fa-unlock-alt"></i>
                    </div>

                    <input id="validatePassword" name="" type="password" class="form__input" placeholder="Contrase??a de nuevo" required minlength="6">
                </div>
            </div>

            <div class="input-tablet text-center">
                <p class="alert-danger display-none" id="alert-password">Las contrase??as no coinciden</p>
            </div>

            <div class="input-tablet">
                <div class="form__container-input">
                    <div class="form__icon">
                        <i class="far fa-address-card"></i>
                    </div>

                    <input minlength="8" maxlength="8" name="ci" type="text" class="form__input" placeholder="C??dula sin puntos ni guiones" required id="cedula" <?php if ($rellenar) : ?> value="<?php if ($rellenar) echo "$cedula"; ?>" <?php endif; ?>>

                </div>

                <div class="form__container-input">
                    <div class="form__icon">
                        <i class="far fa-envelope"></i>
                    </div>

                    <input name="email" type="email" class="form__input" placeholder="Email" required<?php if ($rellenar) : ?> value="<?php if ($rellenar) echo "$email"; ?>" <?php endif; ?>>

                </div>
            </div>

            <div class="input-tablet text-center">
                <p class="alert-warning display-none" id="alert-cedula">La c??dula solo debe contener n??meros, sin puntos y sin guiones</p>
            </div>


            <div class="form__container-input flexColumn-nocenter m3">
                <div class="text-center">
                    <label for="grupos" class="label"> <span class="bold">Grupos</span> (Si est?? en PC, mantenga CTRL/CMD para seleccionar m??s de uno)</label>
                </div>

                <select id="grupos" name="grupos[]" class="form__select" multiple required>
                    <?php Sistema::cargarGrupos($db); ?>
                </select>
            </div>

            <div class="button-center">
                <button id="submit" class="btn-submit" type="submit">Solicitar unirse</button>
            </div>
        </form>

    </div>
    </div>

    <script src="../../../build/js/validateUsers.js"></script>
    <script src="../../../build/js/removeAlert.js"></script>
    </body>

</html>