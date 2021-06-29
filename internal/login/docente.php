<?php
require '../../config/app.php';
require '../../clases/Docente.php';

$yaExiste = false; // Pasa  true cuando el usuario ya exista
$success = false; // Pasa a true cuando todo haya salido correcto
$rellenar = false; // Pasa a true cuando haya que volver a rellenar el formulario (caso de error)

// Comprobar que los datos hayan sido enviado en POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    // Comprobar si ya existe en la base de datos
    $yaExiste = Docente::revisarExistencia($_POST['ci'], $db);

    // En caso de que NO exista, lo ingresamos al sistema
    if (!$yaExiste) {
        $success = Docente::crear($_POST, $db);
    } else {
        // En caso de que exista, relleno los campos nuevamente para que cambie algo
        $rellenar = true;
        $nombre = $_POST['nombre'];
        $cedula = $_POST['ci'];
        $apellido = $_POST['apellido'];
        $asignatura = $_POST['asignatura'];
    }
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

    <div class="form__form-container--signup">
        <form action="" method="POST" class="width100">

            <div class="text-center">
                <!-- Si ya esta registrado mostramos un error -->
                <?php if ($yaExiste) : ?>
                    <p id="danger" class="alert-danger">El usuario ya existe</p>
                <?php endif; ?>

                <?php if ($success) : ?>
                    <p id="success" class="alert-success">Registrado correctamente</p>
                <?php endif; ?>

                <h2 class="form__heading">Registro docente</h2>
            </div>

            <!-- Contenedor icono + input -->
            <div class="input-tablet">
                <div class="form__container-input">
                    <div class="form__icon">
                        <i class="far fa-user"></i>
                    </div>

                    <input 
                    name="nombre" 
                    type="text" 
                    class="form__input" 
                    placeholder="Nombre" 
                    required
                    <?php if($rellenar) : ?>
                        value=" <?php if($rellenar) echo "$nombre"; ?>"
                    <?php endif; ?>
                    >

                </div>

                <div class="form__container-input">
                    <div class="form__icon">
                        <i class="far fa-user"></i>
                    </div>

                    <input 
                    name="apellido" 
                    type="text" 
                    class="form__input" 
                    placeholder="Apellido" 
                    required
                    <?php if($rellenar) : ?>
                        value=" <?php if($rellenar) echo "$apellido"; ?>"
                    <?php endif; ?>
                    >

                </div>
            </div>


            <!-- Contenedor icono + input -->
            <div class="input-tablet">
                <div class="form__container-input">
                    <div class="form__icon">
                        <i class="fas fa-unlock-alt"></i>
                    </div>

                    <input id="password" name="contrasena" type="password" class="form__input" placeholder="Contraseña" required minlength="6">

                </div>

                <div class="form__container-input">
                    <div class="form__icon">
                        <i class="fas fa-unlock-alt"></i>
                    </div>

                    <input id="validatePassword" name="validatePassword" type="password" class="form__input" placeholder="Contraseña de nuevo" required minlength="6">

                </div>
            </div>

            <div class="input-tablet text-center">
                <p class="alert-danger display-none" id="alert-password">Las contraseñas no coinciden</p>
            </div>

            <div class="input-tablet">
                <div class="form__container-input">
                    <div class="form__icon">
                        <i class="far fa-address-card"></i>
                    </div>

                    <input 
                    name="ci" 
                    type="text" 
                    class="form__input" 
                    placeholder="Cédula" 
                    required 
                    maxlength="8" 
                    id="cedula"
                    <?php if($rellenar) : ?>
                        value=" <?php if($rellenar) echo "$cedula"; ?>"
                    <?php endif; ?>
                    >

                </div>

                <div class="form__container-input">
                    <div class="form__icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>

                    <input 
                    name="asignatura" 
                    type="text" 
                    class="form__input"
                    placeholder="Asignatura" 
                    required
                    <?php if($rellenar) : ?>
                        value=" <?php if($rellenar) echo "$asignatura"; ?>"
                    <?php endif; ?>
                    >

                </div>
            </div>

            <div class="form__container-input marginTop">
                <div class="form__icon form__icon--profile">
                    <i class="fas fa-image"></i>
                </div>



                <label for="imagen" class="label-img">Foto de perfil</label>

                <input id="imagen" name="imagen" type="file" accept="image/*" class="form__input form__input--file">

            </div>

            <div class="button-center">
                <button id="submit" class="btn-submit" type="submit">Registrar docente</button>
            </div>


        </form>
    </div>

    <script src="/build/js/validateUsers.js"></script>
    <script src="/build/js/removeAlert.js"></script>
    </body>

</html>