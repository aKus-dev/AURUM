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
    <title>AURUM: Registrate</title>
</head>

<body>

    <main class="form bg-main">
        <div class="text-center">
            <a href="../../index.html">
                <img class="form__logo" src="../../build/img/AURUM.svg" alt="">
            </a>
        </div>ç
    </main>

    <div class="form__form-container">


        <div class="form__choose">
            <h2 id="register-text">Registro</h2>

            <p class="form__option" id="option-text">¿Como desea registrarse?</p>
            <div class="width100">
                <a href="./docente.php">
                    <button class="btn btn-signup btn-docente" type="submit" id="btn-teacher">
                        Docente
                    </button>
                </a>
           
            </div>

            
            <div class="width100">
                <a href="./alumno.php">
                    <button class="btn btn-signup btn-alumno" type="submit" id="btn-student">
                        Alumno
                    </button>
                </a>
            </div>
        </div>
        
    </div>


    <script src="/languages/signup.js"></script>
</body>

</html>