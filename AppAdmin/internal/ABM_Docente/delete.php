<form action="">
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

        <input name="accion" value="eliminar_docente" type="hidden">

        <div class="button-center">
            <button class="btn-submit" type="submit">Eliminar docente</button>
        </div>
</form>