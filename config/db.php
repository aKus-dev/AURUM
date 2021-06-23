<?php


function conectarDb(): PDO
{
    $db = new PDO('mysql:host=localhost; dbname=aurum', 'root', 'root');

    if (!$db) {
        echo "Error: No se pudo conectar a MySQL.";
    }

    return $db;
}

conectarDb();
