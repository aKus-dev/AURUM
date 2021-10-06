<?php

require '../../config/app.php';


if (!empty($_POST)) {
    $id = $_POST['id'];
    $CI = '';

    $result = $db->query("SELECT * from pendiente WHERE idAlumno = $id");

    // Inserto todos los datos en la tabla USUARIO
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $CI = $row['CI'];
        $nombre = $row['nombre'];
        $apellido = $row['apellido'];
        $email = $row['email'];
        $password = $row['contrasena'];
        $imagen = $row['imagen'];
        $tipo = $row['tipo'];

        $db->query("INSERT INTO usuario (CI, nombre, apellido, email, contrasena, imagen, tipo, primer_login) VALUES 
        ('$CI', '$nombre', '$apellido', '$email', '$password', '$imagen', '$tipo', 1)");
    } 

    // Obtengo el id que tiene en la tabla USUARIO
    $idReal = null;
    $result = $db->query("SELECT id from usuario WHERE CI = '$CI'");

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $idReal = $row['id'];
    }

    // Selecciono los grupos que tiene en la tabla de grupos pendiente
    $result = $db->query("SELECT * from grupos_pendiente WHERE idAlumno = $id");
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $grupos[] = $row['grupo'];
    }

    // Inserto sus grupos en la tabla de grupos_alumno REAL
    foreach($grupos as $grupo) {
        $db->query("INSERT INTO grupos_alumno VALUES ($idReal, '$grupo')");
    }

    // Borro los datos viejos
    $db->query("DELETE FROM pendiente WHERE idAlumno = $id");
    
    header('Location: ./pendiente.php ');

}
