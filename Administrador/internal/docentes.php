<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="/build/img/AURUM_color.svg">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link rel="stylesheet" href="/build/css/app.css"">
    <title>AURUM: Docentes</title>
</head>
<body>

    <?php include '../templates/header.html'; ?>

    <main class=" asignatura">
    <h2>¿Que desea hacer?</h2>

    <div class="flexRow buttons-container">
        <button class="btn-crud" id="create">Agregar</button>
        <button class="btn-crud" id="update">Modificar</button>
        <button class="btn-crud" id="delete">Eliminar</button>
    </div>
    </main>

    </div>
    <!-- Contenedor de crear -->
    <div id="create-container" class="container-crud container-crud--alumno ">
        <div class="text-center">
            <h2 class="font-size22">Agregar docente</h2>
        </div>

        <!-- Contenedor icono + input -->
        <div class="input-tablet">
            <div class="form__container-input">
                <div class="form__icon">
                    <i class="far fa-user"></i>
                </div>

                <input name="nombre" type="text" class="form__input" placeholder="Nombre" required>
            </div>

            <div class="form__container-input">
                <div class="form__icon">
                    <i class="far fa-user"></i>
                </div>

                <input name="apellido" type="text" class="form__input" placeholder="Apellido" required>
            </div>
        </div>

        <!-- Contenedor icono + input -->
        <div class="input-tablet">
            <div class="form__container-input">
                <div class="form__icon">
                    <i class="fas fa-unlock-alt"></i>
                </div>

                <input name="password" type="text" class="form__input" placeholder="Contraseña" required>
            </div>

            <div class="form__container-input">
                <div class="form__icon">
                    <i class="fas fa-unlock-alt"></i>
                </div>

                <input name="validatePassword" type="text" class="form__input" placeholder="Contraseña de nuevo" required>
            </div>
        </div>

        <div class="input-tablet">
            <div class="form__container-input">
                <div class="form__icon">
                    <i class="far fa-address-card"></i>
                </div>

                <input name="ci" type="text" class="form__input" placeholder="Cédula" required>

            </div>

            <!-- Asignatura -->
            <div class="form__container-input">
                <div class="form__icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>

                <input name="asignatura" type="text" class="form__input" placeholder="Asignatura" required>
            </div>
        </div>

        <div class="button-center">
            <button class="btn-submit" type="submit">Agregar docente</button>
        </div>

    </div>
    <!-- Fin contenedor crear

    <!-- Contenedor de modificar -->
    <div id="update-container" class="container-crud display-none">
        <div class="text-center">
            <h2 class="font-size22">Modificar docente</h2>
        </div>

        <!-- Cedula -->
        <div class="form__container-input">
            <div class="form__icon">
                <i class="far fa-address-card"></i>
            </div>

            <input name="ci" type="text" class="form__input" placeholder="Cédula" required>
        </div>

        <div class="button-center">
            <button class="btn-submit" type="submit">Modificar docente</button>
        </div>
    </div>


    <!-- Contenedor de eliminar -->
    <div id="remove-container" class="container-crud display-none">
        <div class="text-center">
            <h2 class="font-size22">Eliminar docente</h2>
        </div>

        <!-- Cedula -->
        <div class="form__container-input">
            <div class="form__icon">
                <i class="far fa-address-card"></i>
            </div>

            <input name="ci" type="text" class="form__input" placeholder="Cédula" required>
        </div>


        <div class="button-center">
            <button class="btn-submit" type="submit">Eliminar docente</button>
        </div>

        <script src="../../build/js/abmButtons.js"></script>
        </body>

</html>