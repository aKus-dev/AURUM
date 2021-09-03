<?php

require '../../config/app.php';
require '../../clases/docente.php';
require '../../clases/Chat.php';

isAuth_docente();
Chat::offlineDocente($_SESSION['CI'], $db);


if(!empty($_GET)) {
    if(isset($_GET['delete'])) {
        Docente::eliminarDocente($_SESSION['id'], $db);
    }
}

$success = false;
$error = false;

// En caso de que las contraseñas no coincidan
if(!empty($_GET)) {
    $error = isset($_GET['error']);
}

// En caso de que se haya registrado correctamente
if(!empty($_GET)) {
    $success = isset($_GET['success']);
}

// Obtengo los datos del docente
$id = $_SESSION['id'];
$nombreDocente = '';
$apellidoDocente = '';

$sql = "SELECT nombre, apellido FROM docente WHERE id = $id";
$resultado = $db->query($sql);

// Recorro los datos del docente
while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
    $nombreDocente = $row['nombre'];
    $apellidoDocente = $row['apellido'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'];
    $passwordValidate = $_POST['passwordValidate'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $imagen = $_POST['imagen'];

    // Invoco el metodo de modificar
    docente::modificar($db,$nombre, $apellido, $password, $passwordValidate, $imagen);
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
    <title>AURUM: Perfil</title>
</head>
<body>


    <div class="alumno-container">
    <?php include '../templates/header.html' ?>

    <div class="pt-3 profile-container">
        <!-- Se registro correctamente-->
        <?php if ($success) : ?>
            <div class="text-center">
                <p id="success" class="alert-success">Cambios guardados correctamente</p>
            </div>
        <?php endif; ?>

        <div class="user-profile">
            <img class="photo_user" src="<?php echo $_SESSION['imagen'] ?>" alt="">

            <div class="user_data">
                <p><?php echo $nombreDocente . " " . $apellidoDocente ?></p>
            </div>

            <form action="" class="profile-form" method="POST">
                <div class="profile-form-container">
                    <input minlength="3" name="nombre" type="text" value="<?php echo $nombreDocente ?>">
                    <i class="far fa-edit"></i>
                </div>

                <div class="profile-form-container">
                    <input minlength="3" name="apellido" type="text" value="<?php echo $apellidoDocente ?>">
                    <i class="far fa-edit"></i>
                </div>

                <div class="profile-form-container">
                    <input name="password" type="password" placeholder="Nueva contraseña" id="password" minlength="6">
                    <i class="far fa-edit"></i>
                </div>

                <div class="profile-form-container">
                    <input name="passwordValidate" type="password" placeholder="Repite la nueva contraseña" id="passwordValidate" minlength="6">
                    <i class="far fa-edit"></i>
                </div>

                <!-- Se registro correctamente-->
                <?php if ($error) : ?>
                    <div class="text-center">
                        <p id="danger" class="alert-danger">Las contraseñas no coinciden</p>
                    </div>
                <?php endif; ?>

                <div class="text-center">
                    <p class="text-violet p-profile">Cambia tu foto</p>
                </div>


                <div class="profile-images">
                    <div>
                        <img class="/build/public/Profesor_1.svg" id="perfil1" src="/build/public/Profesor_1.svg" alt="">
                    </div>

                    <div>
                        <img class="/build/public/Profesor_2.svg" id="perfil2" src="/build/public/Profesor_2.svg" alt="">
                    </div>

                    <div>
                        <img class=/build/public/Profesor_3.svg" id="perfil3" src="/build/public/Profesor_3.svg" alt="">
                    </div>

                    <div>
                        <img class="/build/public/Profesor_4.svg" id="perfil4" src="/build/public/Profesor_4.svg" alt="">
                    </div>

                    <div>
                        <img class=/build/public/Profesor_5.svg" id="perfil5" src="/build/public/Profesor_5.svg" alt="">
                    </div>

                    <div>
                        <img class="/build/public/Profesor_6.svg" id="perfil6" src="/build/public/Profesor_6.svg" alt="">
                    </div>

                    <div>
                        <img class="/build/public/Profesor_7.svg" id="perfil7" src="/build/public/Profesor_7.svg" alt="">
                    </div>

                    <div>
                        <img class="/build/public/Profesor_8.svg" id="perfil8" src="/build/public/Profesor_8.svg" alt="">
                    </div>

                    <div>
                        <img class="/build/public/Profesor_9.svg" id="perfil9" src="/build/public/Profesor_9.svg" alt="">
                    </div>
                    
   
                </div>

                <input name="imagen" id="src-image" type="hidden">

                <button id="submit" class="bg-main">Guardar cambios</button>
            </form>

            <div class="text-center">
                <button id="btn-delete" class="btn-delete">Eliminar cuenta</button>
            </div>
        </div>

    </div>
    </div>

    <div id="modal" class="modal-eliminar hide-modal">
        <div class="confirm">
            <p class="msg">¿Estás seguro que deseas eliminar tu cuenta?</p>

            <form>
            <input name="delete" value="true" type="hidden">
            <p id="btn-cancelar" class="btn-cancel">Cancelar</p>
            <button id="btn-confirm" class="btn-delete">Confirmar</button>
            </form>
        </div>
    </div>

    <script src="/build/js/removeAlert.js"></script>
    <script src="/build/js/perfil.js"></script>
    <script src="/build/js/modal.js"></script>
    </body>

</html>