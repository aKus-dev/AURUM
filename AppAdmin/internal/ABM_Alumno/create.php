<?php

?>
<!-- Contenedor de crear -->
<div id="create-container" class="container-crud container-crud--alumno ">

    <form action="" method="POST" class="width100">
        <!-- Contenedor icono + input -->
        <div class="input-tablet">
            <div class="form__container-input">
                <div class="form__icon">
                    <i class="far fa-user"></i>
                </div>

                <input name="nombre" minlength="3" type="text" class="form__input" placeholder="Nombre" required <?php if ($rellenar) : ?> value="<?php if ($rellenar) echo "$nombre"; ?>" <?php endif; ?>>

            </div>

            <div class="form__container-input">
                <div class="form__icon">
                    <i class="far fa-user"></i>
                </div>

                <input name="apellido" minlength="3" type="text" class="form__input" placeholder="Apellido" required <?php if ($rellenar) : ?> value="<?php if ($rellenar) echo "$apellido"; ?>" <?php endif; ?>>

            </div>
        </div>


        <!-- Contenedor icono + input -->
        <div class="input-tablet">
            <div class="form__container-input">
                <div class="form__icon">
                    <i class="fas fa-unlock-alt"></i>
                </div>

                <input id="password" name="contrasena" type="password" class="form__input" placeholder="Contraseña" required minlength="6">

            </div>

            <div class="form__container-input">
                <div class="form__icon">
                    <i class="fas fa-unlock-alt"></i>
                </div>

                <input id="validatePassword" name="" type="password" class="form__input" placeholder="Contraseña de nuevo" required minlength="6">
            </div>
        </div>

        <div class="input-tablet text-center">
            <p class="alert-danger display-none" id="alert-password">Las contraseñas no coinciden</p>
        </div>

        <div class="input-tablet">
            <div class="form__container-input">
                <div class="form__icon">
                    <i class="far fa-address-card"></i>
                </div>

                <input minlength="8" maxlength="8" name="ci" type="text" class="form__input" placeholder="Cédula sin puntos ni guiones" required id="cedula" <?php if ($rellenar) : ?> value="<?php if ($rellenar) echo "$cedula"; ?>" <?php endif; ?>>

            </div>

            <div class="form__container-input">
                <div class="form__icon">
                    <i class="far fa-envelope"></i>
                </div>

                <input name="email" type="email" class="form__input" placeholder="Email" required<?php if ($rellenar) : ?> value="<?php if ($rellenar) echo "$email"; ?>" <?php endif; ?>>

            </div>
        </div>

        <div class="input-tablet text-center">
            <p class="alert-warning display-none" id="alert-cedula">La cédula solo debe contener números, sin puntos y sin guiones</p>
        </div>


        <div class="form__container-input flexColumn-nocenter m3">
            <div class="text-center">
                <label for="grupos" class="label"> <span class="bold">Grupos</span> (Si está en PC, mantenga CTRL/CMD para seleccionar más de uno)</label>
            </div>

            <select id="grupos" name="grupos[]" class="form__select" multiple required>
                <option value="1BA">1ºBA</option>
                <option value="1BB">1ºBB</option>
                <option value="1BC">1ºBC</option>
                <option value="1BD">1ºBD</option>
                <option value="1BE">1ºBE</option>
                <option value="1BF">1ºBF</option>
                <option value="1BG">1ºBG</option>
                <option value="1BH">1ºBH</option>
                <option value="2BA">2ºBA</option>
                <option value="2BB">2ºBB</option>
                <option value="2BC">2ºBC</option>
                <option value="2BD">2ºBD</option>
                <option value="2BE">2ºBE</option>
                <option value="2BF">2ºBF</option>
                <option value="2BG">2ºBG</option>
                <option value="2BH">2ºBH</option>
                <option value="3BA">3ºBA</option>
                <option value="3BB">3ºBB</option>
                <option value="3BC">3ºBC</option>
                <option value="3BD">3ºBD</option>
                <option value="3BE">3ºBE</option>
                <option value="3BF">3ºBF</option>
                <option value="3BG">3ºBG</option>

            </select>
        </div>

        <input type="hidden" name="tipo" value="alta_alumno">

        <div class="button-center">
            <button id="submit" class="btn-submit" type="submit">Solicitar unirse</button>
        </div>
    </form>

</div>
<!-- Fin contenedor crear