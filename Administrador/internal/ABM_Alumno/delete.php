<?php 
 
// Revisar si se ha enviado en metodo POST
if($_SERVER['REQUEST_METHOD']  === 'POST') {
    
    if($_POST['accion'] == 'eliminar_alumno') {
        Administrador::eliminarAlumno($_POST['ci'], $db);
    }
}

?>


<!-- Contenedor de eliminar -->
<div id="remove-container" class="container-crud display-none">
        <form action="" method="POST">
            <div class="text-center">
                <h2 class="font-size22">Eliminar alumno</h2>
            </div>

            <!-- Cedula -->
            <div class="form__container-input">
                <div class="form__icon">
                    <i class="far fa-address-card"></i>
                </div>

                <input name="ci" type="text" class="form__input" placeholder="Cédula" maxlength="8" required>
            </div>

            <input name="accion" value="eliminar_alumno" type="hidden">


            <div class="button-center">
                <button class="btn-submit" type="submit">Eliminar alumno</button>
            </div>
    </form>
</div>