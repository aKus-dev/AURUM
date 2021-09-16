<?php
require '../../../config/app.php';
require '../../../clases/Administrador.php';

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


    <form action="">
        <!-- Contenedor de eliminar -->
        <div id="remove-container" class="container-crud">
            <div class="text-center">
                <h2 class="font-size22">Elimina una asignatura</h2>
            </div>

            <!-- Asignatura -->
            <div class="form__container-input">
                <select name="grupo" class="form__select">
                    <option selected disabled>Asignatura</option>
                    <option value="3BE">Programación Web</option>
                </select>
            </div>

            <!-- Grado -->
            <div class="form__container-input">
                <select name="grado" class="form__select" required>
                    <option selected disabled>Grado de la asignatura</option>
                    <option value="1">1º Año</option>
                    <option value="2">2º Año</option>
                    <option value="3">3º Año</option>
                </select>
            </div>

            <input name="accion" value="eliminar_asignatura" type="hidden">

            <div class="button-center">
                <button class="btn-submit" type="submit">Eliminar asignatura</button>
            </div>
    </form>


    </div>

    <script src="../../build/js/abmButtons.js"></script>
    </body>

</html>