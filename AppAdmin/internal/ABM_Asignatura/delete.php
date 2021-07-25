<form action="">
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

        <input name="accion" value="eliminar_asignatura" type="hidden">

        <div class="button-center">
            <button class="btn-submit" type="submit">Eliminar asignatura</button>
        </div>
</form>