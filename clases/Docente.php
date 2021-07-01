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
        $grupos = $datos['grupos'];
        $asignaturas = $datos['asignaturas']; 
        $contrasena = $datos['contrasena']; 
        $imagen = 'null';
        
        // Hashear password
        $passwordHash = password_hash($contrasena, PASSWORD_BCRYPT);

        // Codigo SQL
        $sql = "INSERT INTO Docente (CI,nombre,apellido, contrasena, imagen, primer_login) VALUES 
        ('$CI', '$nombre', '$apellido', '$passwordHash', '$imagen', true)"; 

        $stmt = $db->prepare($sql); // prepare() optimiza el query y evita inyecciones no validas
        if($stmt->execute()) { // Lo ejecutamos

            // Guardo la cedula en la tabla de cedulas
            $sql = "INSERT INTO cedulas VALUES ('$CI') ";
            $db->query($sql);

            
            // Registro las asignaturas
            self::registrarAsignaturas($asignaturas, $CI, $db);
            // Registro los grupos
            self::registrarGrupos($grupos, $CI, $db);


            return true; // Si todo esta correcto, retornamos true
        }
    }

    static public function registrarAsignaturas($asignaturas, $CI, $db) {
        $sql = "SELECT id FROM docente WHERE ci = '$CI' LIMIT 1";
    
        $resultado = $db->query($sql);

        // Iterar resultados;
        while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
            foreach($asignaturas as $asignatura) {
                $idDocente = $row['id'];
                $sql = "INSERT INTO asignaturas_docente VALUES ($idDocente, '$asignatura')";

                $stmt = $db->prepare($sql);
                $stmt->execute();
            }
        }
    }

    static public function registrarGrupos($grupos, $CI, $db) {
        $sql = "SELECT id FROM docente WHERE ci = '$CI' LIMIT 1";
    
        $resultado = $db->query($sql);

        // Iterar resultados;
        while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
            foreach($grupos as $grupo) {
                $idDocente = $row['id'];
                $sql = "INSERT INTO grupos_docente VALUES ($idDocente, '$grupo')";

                $stmt = $db->prepare($sql);
                $stmt->execute();
            }
        }
    }

    
    static public function revisarExistencia(string $cedula, object $db) : bool {
        $sql = "SELECT * FROM cedulas WHERE cedula = '$cedula' ";

        $resultado = $db->query($sql);

        // Si entra en el while es porque encontró una cedula
        while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
           return true;
        }
     
        return false;
          
    }

}