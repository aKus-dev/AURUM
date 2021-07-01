<?php

session_start();

$cerrarSesion = session_destroy();

// En caso de que se haya podido cerrar sesion
if($cerrarSesion) {
    header('Location: ../index.html');
}


