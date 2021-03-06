<?php
require '../../../config/app.php';
require '../../../clases/Administrador.php';
require '../../../clases/Sistema.php';

isAuth_admin();

$noEncontrado = false;
$cargarDatos = false;
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ci_modificar'])) {

    $resultado = Administrador::getDAtosUsuario($_POST['ci'], $db);

    $resultado ? $cargarDatos = true : $noEncontrado = true;
}

if ($_SERVER['REQUEST_METHOD']  === 'POST' && isset($_POST['datos_modificados'])) {
    $success = Administrador::modificarUsuario($_POST, 'docente', $db);
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
    <title>AURUM: Modificar Docente</title>
</head>
<body>

    <?php include '../../templates/header.php'; ?>

    <main class=" admin-form">

    <h2>¿Que desea hacer?</h2>

    <div class="flexRow buttons-container">
        <a href="./create.php" class="btn-crud">Agregar</a>
        <a href="#" class="btn-crud">Modificar</a>
        <a href="./delete.php" class="btn-crud">Eliminar</a>
    </div>

    </main>


    <!-- Contenedor de modificar -->
    <div id="update-container" class="container-crud <?php if ($cargarDatos) echo "display-none" ?>">

        <div class="text-center">

            <!-- Si la cedula no tiene 8 digitos  -->
            <?php if ($noEncontrado) : ?>
                <p id="danger" class="alert-danger">La cédula no ha sido encontrada</p>
            <?php endif; ?>

            <!-- Se registro correctamente-->
            <?php if ($success) : ?>
                <p id="success" class="alert-success">Modificado correctamente</p>
            <?php endif; ?>

        </div>

        <form action="" method="POST">
            <div class="text-center">
                <h2 class="font-size22">Cédula de docente a modificar</h2>
            </div>

            <!-- Cedula -->
            <div class="form__container-input">
                <div class="form__icon">
                    <i class="far fa-address-card"></i>
                </div>

                <input name="ci" type="text" class="form__input" placeholder="Cédula" maxlength="8">
            </div>

            <input type="hidden" name="ci_modificar" value="true">

            <div class="button-center">
                <button class="btn-submit" type="submit">Modificar</button>
            </div>
        </form>
    </div>


    <!-- Contenedor de crear -->
    <div id="create-container" class="container-crud container-crud--alumno <?php if (!$cargarDatos) echo "display-none"  ?>">

        <div class="text-center">
            <h2 class="font-size22">Modifique los datos</h2>
        </div>

        <form action="" method="POST" class="width100">
            <!-- Contenedor icono + input -->
            <div class="input-tablet">
                <div class="form__container-input">
                    <div class="form__icon">
                        <i class="far fa-user"></i>
                    </div>

                    <input value="<?php echo $resultado['nombre'] ?>" name="nombre" minlength="3" type="text" class="form__input" placeholder="Nombre">
                    

                </div>

                <div class="form__container-input">
                    <div class="form__icon">
                        <i class="far fa-user"></i>
                    </div>

                    <input value="<?php echo $resultado['apellido'] ?>" name="apellido" minlength="3" type="text" class="form__input" placeholder="Apellido" >

                </div>
            </div>


            <!-- Contenedor icono + input -->
            <div class="input-tablet">
                <div class="form__container-input">
                    <div class="form__icon">
                        <i class="fas fa-unlock-alt"></i>
                    </div>

                    <input id="password" name="contrasena" type="password" class="form__input" placeholder="Nueva contraseña"  minlength="6">

                </div>

                <div class="form__container-input">
                    <div class="form__icon">
                        <i class="fas fa-unlock-alt"></i>
                    </div>

                    <input id="validatePassword" name="" type="password" class="form__input" placeholder="Contraseña de nuevo"  minlength="6">
                </div>
            </div>

            <div class="input-tablet text-center">
                <p class="alert-danger display-none" id="alert-password">Las contraseñas no coinciden</p>
            </div>

            <div class="input-tablet">

                <div class="form__container-input">
                    <div class="form__icon">
                        <i class="far fa-envelope"></i>
                    </div>

                    <input value="<?php echo $resultado['email'] ?>" name="email" type="email" class="form__input" placeholder="Email" >

                </div>
            </div>

            <div class="input-tablet text-center">
                <p class="alert-warning display-none" id="alert-cedula">La cédula solo debe contener números, sin puntos y sin guiones</p>
            </div>

            <div class="form__container-input flexColumn-nocenter m3">
                <div class="text-center">
                    <label for="asignaturas" class="label"><span class="bold">Asignaturas</span> (Si está en PC, mantenga CTRL/CMD para seleccionar más de uno)</label>
                </div>

                <select id="asignaturas" name="asignaturas[]" class="form__select" multiple >
                    <?php Sistema::cargarAsignaturas($db) ?>
                </select>
            </div>


            <div class="form__container-input flexColumn-nocenter m3">
                <div class="text-center">
                    <label for="grupos" class="label"> <span class="bold">Grupos</span> (Si está en PC, mantenga CTRL/CMD para seleccionar más de uno)</label>
                </div>

                <select id="grupos" name="grupos[]" class="form__select" multiple >
                    <?php Sistema::cargarGrupos($db); ?>
                </select>
            </div>


            <input type="hidden" name="id" value="<?php echo $resultado['id']; ?>">
            <input type="hidden" name="datos_modificados" value="true">

            <div class="button-center">
                <button id="submit" class="btn-submit" type="submit">Solicitar unirse</button>
            </div>
        </form>

    </div>


    <script src="../../../build/js/validateUsers.js"></script>
    <script src="../../../build/js/removeAlert.js"></script>
    </body>

</html>