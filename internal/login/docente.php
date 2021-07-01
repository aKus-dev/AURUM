<?php
require '../../config/app.php';
require '../../clases/Docente.php';

$yaExiste = false; // Pasa  true cuando el usuario ya exista
$success = false; // Pasa a true cuando todo haya salido correcto
$rellenar = false; // Pasa a true cuando haya que volver a rellenar el formulario (caso de error)

// Comprobar que los datos hayan sido enviado en POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    // Comprobar si ya existe en la base de datos
    $yaExiste = Docente::revisarExistencia($_POST['ci'], $db);

    // En caso de que NO exista, lo ingresamos al sistema
    if (!$yaExiste) {
        $success = Docente::crear($_POST, $db);
    } else {
        // En caso de que exista, relleno los campos nuevamente para que cambie algo
        $rellenar = true;
        $nombre = $_POST['nombre'];
        $cedula = $_POST['ci'];
        $apellido = $_POST['apellido'];
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../../build/img/AURUM_color.svg">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link rel="stylesheet" href="../../build/css/app.css"">
    <title>AURUM: Inicia sesión</title>
</head>

<body>

  <main class=" form bg-main">
    <div class="text-center">
        <a href="../../index.html">
            <img class="form__logo" src="../../build/img/AURUM.svg" alt="">
        </a>
    </div>
    </main>

    <div class="form__form-container--signup">
        <form action="" method="POST" class="width100">

            <div class="text-center">
                <!-- Si ya esta registrado mostramos un error -->
                <?php if ($yaExiste) : ?>
                    <p id="danger" class="alert-danger">El usuario ya existe</p>
                <?php endif; ?>

                <?php if ($success) : ?>
                    <p id="success" class="alert-success">Registrado correctamente</p>
                <?php endif; ?>

                <h2 class="form__heading">Registro docente</h2>
            </div>

            <!-- Contenedor icono + input -->
            <div class="input-tablet">
                <div class="form__container-input">
                    <div class="form__icon">
                        <i class="far fa-user"></i>
                    </div>

                    <input 
                    name="nombre" 
                    type="text" 
                    class="form__input" 
                    placeholder="Nombre" 
                    required
                    <?php if($rellenar) : ?>
                        value="<?php if($rellenar) echo "$nombre"; ?>"
                    <?php endif; ?>
                    >

                </div>

                <div class="form__container-input">
                    <div class="form__icon">
                        <i class="far fa-user"></i>
                    </div>

                    <input 
                    name="apellido" 
                    type="text" 
                    class="form__input" 
                    placeholder="Apellido" 
                    required
                    <?php if($rellenar) : ?>
                        value="<?php if($rellenar) echo "$apellido"; ?>"
                    <?php endif; ?>
                    >

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

                    <input id="validatePassword" name="validatePassword" type="password" class="form__input" placeholder="Contraseña de nuevo" required minlength="6">

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

                    <input 
                    name="ci" 
                    type="text" 
                    class="form__input" 
                    placeholder="Cédula" 
                    required 
                    maxlength="8" 
                    id="cedula"
                    <?php if($rellenar) : ?>
                        value="<?php if($rellenar) echo "$cedula"; ?>"
                    <?php endif; ?>
                    >

                </div>
            </div>

            
        <div class="input-tablet text-center">
            <p class="alert-warning display-none" id="alert-cedula">La cédula solo debe contener números, sin puntos y sin guiones</p>
        </div>

        <div class="form__container-input flexColumn-nocenter m3">
            <div class="text-center">
                <label for="asignaturas" class="label"><span class="bold">Asignaturas</span> (Si está en PC, mantenga CTRL/CMD para seleccionar más de uno)</label>
            </div>

               <select id="asignaturas" name="asignaturas[]" class="form__select" multiple required>
                 <option value="ada">ADA</option>
                 <option value="fisica1">Física I</option>
                 <option value="fisica2">Física II</option>
                 <option value="historia">Historia</option>
                 <option value="economia">Economía</option>
                 <option value="sociologia">Sociología</option>
                 <option value="proyecto">Proyecto</option>
                 <option value="filosofia">Filosofía</option>
                 <option value="matematicas1">Matemáticas I</option>
                 <option value="matematicas2">Matemáticas II</option>
                 <option value="matematicas3">Matemáticas III</option>
                 <option value="geometria1">Geometría I</option>
                 <option value="geometria2">Geometría I</option>
                 <option value="programacion1">Programación I</option>
                 <option value="programacion2">Programación II</option>
                 <option value="programacion_web">Programación Web</option>
                 <option value="diseno_web1">Diseño web I</option>
                 <option value="diseno_web2">Diseño web II</option>
                 <option value="formacion_empresarial">Formación Empresarial</option>
                 <option value="so1">Sistemas Operativos I</option>
                 <option value="so2">Sistemas Operativos II</option>
                 <option value="so3">Sistemas Operativos III</option>
                </select>
            </div>

            <div class="form__container-input flexColumn-nocenter m3">
               <div class="text-center">
                <label for="grupos" class="label"> <span class="bold">Grupos</span>  (Si está en PC, mantenga CTRL/CMD para seleccionar más de uno)</label>
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

            <div class="form__container-input marginTop">
                <div class="form__icon form__icon--profile">
                    <i class="fas fa-image"></i>
                </div>



                <label for="imagen" class="label-img">Foto de perfil</label>

                <input id="imagen" name="imagen" type="file" accept="image/*" class="form__input form__input--file">

            </div>

            <div class="button-center">
                <button id="submit" class="btn-submit" type="submit">Registrar docente</button>
            </div>


        </form>
    </div>

    <script src="/build/js/validateUsers.js"></script>
    <script src="/build/js/removeAlert.js"></script>
    </body>

</html>