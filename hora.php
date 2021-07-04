<?php

// Días (1: lunes 7: domingo)
$dia = date('N');

// Horas (0 - 23)
$horas = date('G');

// Suponemos que el profesor atiende de lunes a viernes entre 8hs y 18hs
if($dia >= 1 && $dia <= 5 && $hora >= 8 && $hora <= 18) {
    echo "Horario valido";
} else { 
    echo "Horario no valido";
}