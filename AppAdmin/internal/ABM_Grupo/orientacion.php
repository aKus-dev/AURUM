<?php

$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crear_orientacion'])) {
   $success = Administrador::altaOrientacion($_POST['orientacion'], $db);
}

?>


<!-- Contenedor de crear -->
<div id="create-container" class="container-crud">

    <?php if ($success) : ?>
        <p id="success" class="alert-success">Orientación registrada correctamente</p>
    <?php endif; ?>


    <div class="text-center">
        <h2 class="font-size22">Agrega una orientación</h2>
    </div>

    <form method="POST">
        <!-- Asignatura -->
        <div class="form__container-input">
            <div class="form__icon">
                <i class="fas fa-graduation-cap"></i>
            </div>

            <input name="orientacion" type="text" class="form__input" placeholder="Orientación" required>
        </div>

        <input name="crear_orientacion" value="true" type="hidden">

        <div class="button-center">
            <button class="btn-submit" type="submit">Agregar orientación</button>
        </div>
    </form>
</div>

