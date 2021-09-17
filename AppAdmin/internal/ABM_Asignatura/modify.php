<?php
require '../../../config/app.php';
require '../../../clases/Administrador.php';
require '../../../clases/Sistema.php';

isAuth_admin();

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    Administrador::modificarAsignatura($_POST['asignatura_vieja'], $_POST['asignatura_nueva'], $db);
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
        <a href="./create.php" class="btn-crud">Crear</a>
        <a href="#" class="btn-crud">Modificar</a>
        <a href="./delete.php" class="btn-crud">Eliminar</a>
    </div>
    </main>

    </div>


    </div>

    <form method="POST">
        <!-- Contenedor de modificar -->
        <div id="update-container" class="container-crud">
            <div class="text-center">
                <h2 class="font-size22">Modifica una asignatura</h2>
            </div>
           
            <!-- Asignatura -->
            <div class="form__container-input">
                <select name="asignatura_vieja" class="form__select">
                    <option selected disabled>Seleccione la asignatura</option>
                    <?php Sistema::cargarAsignaturas($db); ?>
                </select>
            </div>
     

            <!-- Nuevo nombre -->
            <div class="form__container-input">
                <div class="form__icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>

                <input name="asignatura_nueva" type="text" class="form__input" placeholder="Nuevo nombre" required>
            </div>


            <div class="button-center">
                <button class="btn-submit" type="submit">Modificar asignatura</button>
            </div>

        </div>
    </form>

    </div>

    <script src="../../build/js/abmButtons.js"></script>
    </body>

</html>