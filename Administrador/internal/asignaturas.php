<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="/build/img/AURUM_color.svg">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css"
        integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link rel="stylesheet" href="/build/css/app.css"">
    <title>AURUM: Asignaturas</title>
</head>
<body>

    <?php include '../templates/header.html'; ?>

    <main class="asignatura">
        <h2>¿Que desea hacer?</h2>

        <div class="flexRow buttons-container">
            <button class="btn-crud" id="create">Crear</button>
            <button class="btn-crud" id="update">Modificar</button>
            <button class="btn-crud" id="delete">Eliminar</button>
        </div>
    </main>
        
    </div>
    <!-- Contenedor de crear -->
    <div id="create-container" class="container-crud">
        <div class="text-center">
            <h2 class="font-size22">Crea una asignatura</h2>
        </div>

        <!-- Orientación -->
        <div class="form__container-input">
            <select name="grupo" class="form__select">
                <option selected disabled>Orientación</option>
                <option value="3BE">Informática</option>
            </select>

        </div>

        <!-- Grupo  -->
        <div class="form__container-input">
            <select name="grupo" class="form__select">
                <option selected disabled>Grupo</option>
                <option value="3BE">3ºBE</option>
            </select>
        </div>

              <!-- Asignatura -->
              <div class="form__container-input">
                <div class="form__icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
    
                <input name="asignatura" type="text" class="form__input" placeholder="Asignatura" required>
            </div>

        <div class="button-center">
            <button class="btn-submit" type="submit">Crear asignatura</button>
        </div>
    </div>

    <!-- Contenedor de modificar -->
    <div id="update-container" class="container-crud display-none">
        <div class="text-center">
            <h2 class="font-size22">Modifica una asignatura</h2>
        </div>


        <!-- Asignatura -->
        <div class="form__container-input">
            <select name="grupo" class="form__select">
                <option selected disabled>Asignatura</option>
                <option value="3BE">Programación Web</option>
            </select>
        </div>

        <!-- Grupo  -->
        <div class="form__container-input">
            <select name="grupo" class="form__select">
                <option selected disabled>Grupo</option>
                <option value="3BE">3ºBE</option>
            </select>
        </div>

        <!-- Nuevo nombre -->
        <div class="form__container-input">
            <div class="form__icon">
                <i class="fas fa-graduation-cap"></i>
            </div>

            <input name="asignatura" type="text" class="form__input" placeholder="Nuevo nombre" required>
        </div>

        <div class="button-center">
            <button class="btn-submit" type="submit">Modificar asignatura</button>
        </div>

    </div>

     <!-- Contenedor de eliminar -->
     <div id="remove-container" class="container-crud display-none">
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

        <!-- Grupo  -->
        <div class="form__container-input">
            <select name="grupo" class="form__select">
                <option selected disabled>Grupo</option>
                <option value="3BE">3ºBE</option>
            </select>
        </div>

        <div class="button-center">
            <button class="btn-submit" type="submit">Eliminar asignatura</button>
        </div>

    </div>

    <script src="../../build/js/abmButtons.js"></script>
    </body>

</html>