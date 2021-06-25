<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../build/img/AURUM_color.svg">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link rel="stylesheet" href="/build/css/app.css"">
    <title>AURUM: Alumno</title>
</head>
<body>


    <div class="alumno-container">
        <?php include '../templates/header.html' ?>

        <div class="crear-consulta">
            <h1>Crear consulta</h1>

            <p>Antes de crearla... ¡revisa si alguien ya preguntó lo mismo!</p>
            <div class="todas-consultas bg-main">
                <p>Ver todas las consultas</p>
                <a href="#">
                    <i class="fas fa-arrow-circle-right white"></i>
                </a>
            </div>

            <p class="empezemos">¡Empezemos!</p>

            <form action="" class="form-consulta">
                <div class="form-alumno-crear">
                    <label for="titulo">Titulo</label>
                    <input id="titulo" type="text" placeholder="Titulo de la consulta">
                </div>

                <div class="form-alumno-crear">
                    <label for="mensaje">Mensaje</label>
                    <textarea id="mensaje" placeholder="Descripción de la consulta"></textarea>
                </div>

                <div>
                    <select name="profesor" class="select-profesor">
                        <option selected disabled>Seleccione un profesor</option>
                    </select>
                </div>

                <div class="btn-submit-consulta">
                    <button type="submit" class="bg-main">Enviar consulta</button>
                </div>
            </form>
        </div>
    </div>
    </body>

</html>