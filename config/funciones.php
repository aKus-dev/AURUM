<?php

// Funcion para visualizar mejor lo que almacena un objeto/array
function debug($value) {
    echo "<pre>";
    print_r($value);
    echo "</pre>";
    exit;
}

function isAuth_admin() {
    session_start();

    // Caso de que no haya iniciado sesion aún
    if(empty($_SESSION)) {
        header('Location: ../index.html');
    } 
     
     // Si inició sesion, verificamos que haya sido como admin
     if(!$_SESSION['sesion_admin']) {
        header('Location: ../index.html') ?? header('Location: ../../index.html');
     } 
     
} 

function isAuth_alumno() {
    session_start();

    // Caso de que no haya iniciado sesion aún
    if(empty($_SESSION)) {
        header('Location: ../index.html');
    } 
     
     // Si inició sesion, verificamos que haya sido como admin
     if(!$_SESSION['sesion_alumno']) {
        header('Location: ../index.html') ?? header('Location: ../../index.html');
     } 
     
} 


function isAuth_docente() {
    session_start();

    // Caso de que no haya iniciado sesion aún
    if(empty($_SESSION)) {
        header('Location: ../index.html');
    } 
     
     // Si inició sesion, verificamos que haya sido como admin
     if(!$_SESSION['sesion_docente']) {
        header('Location: ../index.html') ?? header('Location: ../../index.html');
     } 
     
} 