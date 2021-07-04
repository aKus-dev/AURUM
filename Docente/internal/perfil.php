<?php

require '../../config/app.php';
require '../../clases/docente.php';
isAuth_docente();

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

    // Invoco el metodo de modificar
    docente::modificar($db,$nombre, $apellido, $password, $passwordValidate);
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
    <title>AURUM: docente</title>
</head>
<body>


    <div class=" docente-container">
    <?php include '../templates/header.html' ?>

    <div class="pt-3">
        <!-- Se registro correctamente-->
        <?php if ($success) : ?>
            <div class="text-center">
                <p id="success" class="alert-success">Cambios guardados correctamente</p>
            </div>
        <?php endif; ?>


        <div class="text-center">
            <h2>Tu perfil</h2>
        </div>

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

                <button id="submit" class="bg-main">Guardar cambios</button>
            </form>
        </div>

    </div>
    </div>

    <script src="/build/js/removeAlert.js"></script>
    </body>

</html>