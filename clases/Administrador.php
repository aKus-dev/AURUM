<?php

class Administrador // Falta implementar la interface
{
    private $id;
    private $usuario;
    private $contrasena;
    private $imagen;

    // Constructor una vez inicia sesión
    public function __construct(int $id, string $usuario, string $contrasena, string $imagen) 
    {
        $this->id = $id;
        $this->usuario = $usuario;
        $this->contrasena = $contrasena;
        $this->imagen = $imagen;
    }
        
    static public function crearAlumno(array $datos, object $db) {
        $CI = $datos['ci']; 
        $nombre = $datos['nombre']; 
        $apellido = $datos['apellido'];
        $contrasena = $datos['password']; 
        $grupo = $datos['grupo']; 
        $imagen = $datos['imagen'] ?? 'null';

        // Hashear password
        $passwordHash = password_hash($contrasena, PASSWORD_BCRYPT);

        // Codigo SQL
        $sql = "INSERT INTO Alumno (CI,nombre,apellido,grupo,contrasena,imagen) VALUES 
        ('$CI', '$nombre', '$apellido', '$grupo', '$passwordHash', '$imagen')";

        $stmt = $db->prepare($sql); // prepare() optimiza el query y evita inyecciones no validas
        $stmt->execute(); // Lo ejecuta
 
    }


    static public function eliminarAlumno(string $cedula, object $db) {
        $sql = "DELETE FROM Alumno WHERE CI= '$cedula' "; 
     
        $stmt = $db->prepare($sql); // prepare() optimiza el query y evita inyecciones no validas
        $stmt->execute(); // Lo ejecuta
    }
}