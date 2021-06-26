<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="/build/img/AURUM_color.svg">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link rel="stylesheet" href="/build/css/app.css"">
    <title>AURUM: Docentes</title>
</head>
<body>

    <?php include '../templates/header.html'; ?>

    <main class="admin-form">
    <h2>¿Que desea hacer?</h2>

    <div class="flexRow buttons-container">
        <button class="btn-crud" id="create">Agregar</button>
        <button class="btn-crud" id="update">Modificar</button>
        <button class="btn-crud" id="delete">Eliminar</button>
    </div>
    </main>

    <div>
        <?php include 'ABM_Docente/create.php';  ?> 
        <?php include 'ABM_Docente/modify.php';  ?> 
        <?php include 'ABM_Docente/delete.php';  ?> 
    </div>
    
    <script src="../../build/js/abmButtons.js"></script>
    </body>
</html>