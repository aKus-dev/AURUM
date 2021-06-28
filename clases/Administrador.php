<?php

interface iAdministrador
{
    // Métodos para gestionar alumnos
    static public function crearAlumno(array $datos, object $db);  
    static public function eliminarAlumno(string $cedula, object $db); 
    public function modificarAlumno(string $cedula, object $db);

    // Métodos para gestionar docentes
    public function crearDocente(array $datos, object $db); 
    public function eliminarDocente(string $cedula, object $db); 
    public function modificarDocente(string $cedula, object $db);

    // Métodos para gestionar asignaturas
    public function crearAsignatura(string $orientacion, string $grupo, string $asignatura); 
    public function eliminarAsignatura(string $asingatura, string $grupo); 
    public function modificarAsignatura(string $orientacion, string $grupo, string $nuevoNombre);

    // Métodos para crear grupos y orientaciones
    public function crearGrupo(string $nombre);
    public function crearOrientacion(string $orientacion);

    // Métodos para gestionar alumnos pendientes
    public function aceptarPendiente(int $id);
    public function rechazarPendiente(int $id);
}

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