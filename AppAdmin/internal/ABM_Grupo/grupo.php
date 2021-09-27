<?php

$registrado = false;
$yaRegistrado = false;


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crear_grupo'])) {
    $success = Administrador::altaGrupo($_POST['grupo'], $db);
    $success ? $registrado = true : $yaRegistrado = true;

}

?>


<!-- Contenedor de crear -->
<div id="create-container" class="container-crud">

    <!-- Se registro correctamente-->
    <?php if ($registrado) : ?>
        <p id="success" class="alert-success">Grupo registrado correctamente</p>
    <?php endif; ?>

    <?php if ($yaRegistrado) : ?>
        <p id="danger" class="alert-danger">El grupo ya está registrado</p>
    <?php endif; ?>



    <div class="text-center">
        <h2 class="font-size22">Agrega un grupo</h2>
    </div>

    <form method="POST">
        <!-- Asignatura -->
        <div class="form__container-input">
            <div class="form__icon">
                <i class="fas fa-users"></i>
            </div>

            <input name="grupo" type="text" class="form__input" placeholder="Grupo" required maxlength="4">
        </div>

        <input name="crear_grupo" value="true" type="hidden">

        <div class="button-center">
            <button class="btn-submit" type="submit">Agregar grupo</button>
        </div>
    </form>

</div>