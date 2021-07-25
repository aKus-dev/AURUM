<form action="">
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

        <input name="accion" value="modificar_asignatura" type="hidden">


        <div class="button-center">
            <button class="btn-submit" type="submit">Modificar asignatura</button>
        </div>

    </div>
</form>