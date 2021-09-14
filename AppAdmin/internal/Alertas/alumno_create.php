<?php

$existeCI = false;
$existeMail = false;
$success = false; // Pasa a true cuando todo haya salido correcto
$rellenar = false; // Pasa a true cuando haya que volver a rellenar el formulario (caso de error)
$errorCedula = false;


// Revisar si se ha enviado en metodo POST
// Comprobar que los datos hayan sido enviado en POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['tipo'] === 'alta_alumno') {

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
        $existeCI = Sistema::revisarCedula($_POST['ci'], $_POST['email'], $db);
        $existeMail = Sistema::revisarMail($_POST['ci'], $_POST['email'], $db);

        // En caso de que NO exista, lo ingresamos al sistema
        if (!$existeCI && !$existeMail) {
            $success = Administrador::altaAlumno($_POST, $db);
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

    
<div class="text-center">
        <?php

        if ($existeCI && $existeMail) {
            echo '<p id="danger" class="alert-danger">La cédula y el correo ya están registrados</p>';
        } else if ($existeCI) {
            echo '<p id="danger" class="alert-danger">La cédula ya está registrada</p>';
        } else if ($existeMail) {
            echo '<p id="danger" class="alert-danger">El correo ya está registrado</p>';
        }
        ?>

        <!-- Si la cedula no tiene 8 digitos  -->
        <?php if ($errorCedula) : ?>
            <p id="danger" class="alert-danger">La cédula debe tener 8 digitos</p>
        <?php endif; ?>

        <!-- Se registro correctamente-->
        <?php if ($success) : ?>
            <p id="success" class="alert-success">Registrado correctamente</p>
        <?php endif; ?>

    </div>