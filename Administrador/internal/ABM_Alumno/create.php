<!-- Contenedor de crear -->
<div id="create-container" class="container-crud container-crud--alumno ">
        <div class="text-center">
            <h2 class="font-size22">Agregar alumno</h2>
        </div>

        <form action="">
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

                <div class="form__container-input">

                    <select name="grupo" class="form__select">
                        <option selected disabled>Grupo</option>
                        <option value="3BE">3ºBE</option>
                    </select>

                </div>
            </div>

            <div class="button-center">
                <button class="btn-submit" type="submit">Agregar alumno</button>
            </div>
        </form>

    </div>
    <!-- Fin contenedor crear