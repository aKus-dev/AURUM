<?php

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crear_grupo'])) {
    Administrador::altaGrupo($_POST['grupo'], $db);
}

?>


<!-- Contenedor de crear -->
<div id="create-container" class="container-crud">
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