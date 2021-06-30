<?php

require '../../config/app.php';
isAuth_docente();

$id = $_GET['id'];
$name = $_GET['name'];

$sql = 
"UPDATE Docente
 SET primer_login = false
 WHERE id = $id;
";

$db->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../../build/img/AURUM_color.svg">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css"
        integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link rel="stylesheet" href="../../build/css/app.css">
    <title>AURUM: Te damos la bienvenida</title>
</head>

<body>

    <main class="welcome">

        <section id="section1" class="welcome__grid">

            <div class="text-center welcome__hi">
                <h3 class="welcome__heading">¡Bienvenido, <?php echo $name ?>!</h3>
                <p class="welcome__subtitle">Te enseñaremos lo básico</p>
            </div>

            <div class="welcome__image">
                <img src="../../build/img/Welcome/Welcome1.svg" alt="">
            </div>

            <div class="welcome__text">
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eveniet voluptates aperiam nulla, possimus
                    explicabo, quod vel earum quis deserunt, harum molestiae maxime! Unde, nisi ab minima aperiam
                    voluptatum molestias sunt.</p>


                <button id="btn-siguiente1" class="welcome__btn">Siguiente</button>
            </div>
        </section>

        <section id="section2" class="welcome__grid">

            <div class="text-center welcome__hi">
                <h3 class="welcome__heading">Tu rol como docente</h3>
                <p class="welcome__subtitle">Un vistazo rápido</p>
            </div>

            <div class="welcome__image">
                <img src="../../build/img/Welcome/Welcome2.svg" alt="">
            </div>

            <div class="welcome__text">
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eveniet voluptates aperiam nulla, possimus
                    explicabo, quod vel earum quis deserunt, harum molestiae maxime! Unde, nisi ab minima aperiam
                    voluptatum molestias sunt.</p>
                <div class="btn-flex">
                    <button id="btn-atras2" class="welcome__btn welcome__btn--back">Atras</button>
                    <button id="btn-siguiente2" class="welcome__btn">Siguiente</button>
                </div>
            </div>
        </section>

        <section id="section3" class="welcome__grid">

            <div class="text-center welcome__hi">
                <h3 class="welcome__heading">Estamos para ayudarte</h3>
                <p class="welcome__subtitle">No dudes en contactarnos</p>
            </div>

            <div class="welcome__image">
                <img src="../../build/img/Welcome/Welcome3.svg" alt="">
            </div>

            <div class="welcome__text">
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eveniet voluptates aperiam nulla, possimus
                    explicabo, quod vel earum quis deserunt, harum molestiae maxime! Unde, nisi ab minima aperiam
                    voluptatum molestias sunt.</p>
                <div class="btn-flex">
                    <button id="btn-atras3" class="welcome__btn welcome__btn--back">Atras</button>
                    <a href="/Docente/index.php">
                        <button id="btn-entendido" class="welcome__btn">Entendido</button>
                    </a> 
                </div>
            </div>
        </section>



    </main>

    <script src="/build/js/sliderWelcome.js"></script>
</body>

</html>