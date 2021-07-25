<!-- Contenedor de modificar -->
<div id="update-container" class="container-crud display-none">
        <form action="">
            <div class="text-center">
                <h2 class="font-size22">Cedula alumno</h2>
            </div>

            <!-- Cedula -->
            <div class="form__container-input">
                <div class="form__icon">
                    <i class="far fa-address-card"></i>
                </div>

                <input name="ci" type="text" class="form__input" placeholder="Cédula" required>
            </div>

            <div class="button-center">
                <button class="btn-submit" type="submit">Modificar</button>
            </div>
        </form>
</div>

<!-- Contenedor de crear -->
<div id="update-form" class="mt-5 container-crud container-crud--alumno display-none">
        <div class="text-center">
            <h2 class="font-size22">Modificar alumno</h2>
        </div>

        <form action="" method="POST">
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

                    <input name="password" type="password" class="form__input" placeholder="Contraseña" required>
                </div>

                <div class="form__container-input">
                    <div class="form__icon">
                        <i class="fas fa-unlock-alt"></i>
                    </div>

                    <input name="validatePassword" type="password" class="form__input" placeholder="Contraseña de nuevo" required>
                </div>
            </div>

            <div class="input-tablet">
                <div class="form__container-input">
                    <div class="form__icon">
                        <i class="far fa-address-card"></i>
                    </div>

                    <input name="ci" maxlength="8" type="text" class="form__input" placeholder="Cédula" required>

                </div>

                <div class="form__container-input">

                    <select name="grupo" class="form__select">
                        <option selected disabled>Grupo</option>
                        <option value="3BE">3ºBE</option>
                    </select>

                </div>
            </div>

            <input name="accion" value="crear_alumno" type="hidden">

            <div class="button-center">
                <button class="btn-submit" type="submit">Guardar</button>
            </div>
        </form>

    </div>
    <!-- Fin contenedor crear
