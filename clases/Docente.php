<?php

class Docente {
    private $id;
    private $ci;
    private $nombre;
    private $apellido;
    private $asignatura;
    private $grupos;
    private $contrasena;
    private $imagen;

    public function __construct(int $id, string $ci, string $nombre, string $apellido, string $asignatura, array $grupos, string $contrasena, string $imagen)
    {
        $this->id = $id;
        $this->ci = $ci;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->asignatura = $asignatura;
        $this->grupos = $grupos;
        $this->contrasena = $contrasena;
        $this->imagen = $imagen;
    }

    static public function crear(array $datos, object $db) : bool {

        $CI = $datos['ci']; 
        $nombre = $datos['nombre']; 
        $apellido = $datos['apellido'];
        $grupo = 'sin';
        $asignatura = $datos['asignatura']; 
        $contrasena = $datos['contrasena']; 
        $imagen = 'null';
        
        // Hashear password
        $passwordHash = password_hash($contrasena, PASSWORD_BCRYPT);

        // Codigo SQL
        $sql = "INSERT INTO Docente (CI,nombre,apellido, grupo, asignatura,contrasena,imagen) VALUES 
        ('$CI', '$nombre', '$apellido', '$grupo', '$asignatura', '$passwordHash', '$imagen')";

        $stmt = $db->prepare($sql); // prepare() optimiza el query y evita inyecciones no validas
        if($stmt->execute()) { // Lo ejecutamos
            return true; // Si todo esta correcto, retornamos true
        }
    }

    
    static public function revisarExistencia(string $cedula, object $db) : bool {
        $sql = "SELECT (ci) FROM Docente WHERE ci = $cedula";

        $resultado = $db->query($sql);

        // Si entra en el while es porque encontró una cedula
        while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
           return true;
        }
     
        return false;
          
    }

}