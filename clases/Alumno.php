<?php

interface iAlumno 
{
    // Alta y modificacion
    static public function crear(array $datos);
    public function modificar(int $id);
    static public function revisarExistencia(string $cedula, object $db) : bool; // Revisa si un alumno ya existe

    // Consultas
    public function realizarConsulta(string $titulo, string $descripcion, int $idProfesor);

}

class Alumno {

    private $id;
    private $ci;
    private $nombre;
    private $apellido;
    private $grupo;
    private $contrasena;
    private $imagen;

    public function __construct(int $id, string $ci, string $nombre, string $apellido, string $grupo, string $contrasena, string $imagen)
    {
        $this->id = $id;
        $this->ci = $ci;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->grupo = $grupo;
        $this->contrasena = $contrasena;
        $this->imagen = $imagen;
    }
    
    static public function crear(array $datos, object $db) : bool {

        $CI = $datos['ci']; 
        $nombre = $datos['nombre']; 
        $apellido = $datos['apellido'];
        $contrasena = $datos['contrasena']; 
        $grupo = $datos['grupo']; 
        $imagen = 'null';
        
        // Hashear password
        $passwordHash = password_hash($contrasena, PASSWORD_BCRYPT);

        // Codigo SQL
        $sql = "INSERT INTO Alumno (CI,nombre,apellido,grupo,contrasena,imagen) VALUES 
        ('$CI', '$nombre', '$apellido', '$grupo', '$passwordHash', '$imagen')";

        $stmt = $db->prepare($sql); // prepare() optimiza el query y evita inyecciones no validas
        if($stmt->execute()) { // Lo ejecutamos
            return true; // Si todo esta correcto, retornamos true
        }
    }

    static public function revisarExistencia(string $cedula, object $db) : bool {
        $sql = "SELECT (ci) FROM Alumno WHERE ci = $cedula";

        $resultado = $db->query($sql);

        // Si entra en el while es porque encontró una cedula
        while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
           return true;
        }
     
        return false;
          
    }
}