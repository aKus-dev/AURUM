<form action="">
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

            <input name="accion" value="crear_asignatura" type="hidden">

        <div class="button-center">
            <button class="btn-submit" type="submit">Crear asignatura</button>
        </div>
    </div>
</form>