<?php

// Funcion para visualizar mejor lo que almacena un objeto/array
function debug($value) {
    echo "<pre>";
    print_r($value);
    echo "</pre>";
    exit;
}