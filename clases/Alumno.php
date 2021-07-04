<?php

class Alumno
{

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

    static public function crear(array $datos, object $db): bool
    {

        $CI = $datos['ci'];
        $nombre = $datos['nombre'];
        $apellido = $datos['apellido'];
        $contrasena = $datos['contrasena'];
        $grupos = $datos['grupos'];
        $imagen = '/build/public/Alumno_1.PNG';

        // Hashear password
        $passwordHash = password_hash($contrasena, PASSWORD_BCRYPT);

        // Codigo SQL
        $sql = "INSERT INTO Alumno (CI,nombre,apellido,contrasena,imagen, primer_login) VALUES 
        ('$CI', '$nombre', '$apellido', '$passwordHash', '$imagen', true)";

        $stmt = $db->prepare($sql); // prepare() optimiza el query y evita inyecciones no validas
        if ($stmt->execute()) { // Lo ejecutamos

            // Guardo la cedula en la tabla de cedulas
            $sql = "INSERT INTO cedulas VALUES ('$CI') ";
            $db->query($sql);

            // Registro los grupos
            self::registrarGrupos($grupos, $CI, $db);

            return true; // Si todo esta correcto, retornamos true
        }
    }

    static public function registrarGrupos($grupos, $CI, $db)
    {
        $sql = "SELECT id FROM alumno WHERE ci = '$CI' LIMIT 1";

        $resultado = $db->query($sql);

        // Iterar resultados;
        while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
            foreach ($grupos as $grupo) {
                $idDocente = $row['id'];
                $sql = "INSERT INTO grupos_alumno VALUES ($idDocente, '$grupo')";

                $stmt = $db->prepare($sql);
                $stmt->execute();
            }
        }
    }


    static public function revisarExistencia(string $cedula, object $db): bool
    {
        $sql = "SELECT * FROM cedulas WHERE cedula = '$cedula' ";

        $resultado = $db->query($sql);

        // Si entra en el while es porque encontró una cedula
        while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
            return true;
        }

        return false;
    }

    static public function realizarConsulta(int $idAlumno, int $idDocente, string $titulo, string $descripcion, object $db)
    {

        date_default_timezone_set("America/Montevideo");
        $fecha = date('Y-m-d');

        // Envio los datos a las consultas realizadas por el alumno
        $sqlAlumno = "INSERT INTO consultas_alumno (idAlumno, idDocente, titulo, descripcion, fecha, estado) VALUES
        ($idAlumno, $idDocente, '$titulo', '$descripcion', '$fecha', 'realizada')";

        // Envio los datos a las consultas recibidas del profesor
        $sqlDocente = "INSERT INTO consultas_docente (idAlumno, idDocente, titulo, descripcion, fecha, estado) VALUES
        ($idAlumno, $idDocente, '$titulo', '$descripcion', '$fecha', 'pendiente')";

        $stmt = $db->prepare($sqlAlumno);
        $stmt->execute();

        $stmt = $db->prepare($sqlDocente);
        $stmt->execute();

        return true; // Si todo esta correcto, retornamos true

    }

    static public function cargarProfesores($db)
    {
        // Primero selecciono su grupo
        $id = $_SESSION['id'];
        // Almacena los id de los docentes para que no se repitan si el alumno los tiene en dos grupos distintos
        $existentes = [];

        $sql = "SELECT grupo FROM grupos_alumno WHERE idAlumno = $id";
        $resultado = $db->query($sql);

        // Iterar resultados;
        while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
            $grupos = [$row['grupo']];

            foreach ($grupos as $grupo) {
                // Selecciono los profesores de su grupo
                $sql = "SELECT DISTINCT id, nombre, apellido 
                        FROM docente 
                        INNER JOIN grupos_docente as grupo 
                        ON grupo = '$grupo' AND docente.id = grupo.idDocente";
                $result = $db->query($sql);

                // Itera sobre los profesores obtenidos
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    $id = $row['id'];
                    $nombre = $row['nombre'];
                    $apellido = $row['apellido'];
                    $asignatura = '';

                    // Selecciono sus materias
                    $sql = "SELECT asignatura FROM asignaturas_docente WHERE idDocente = $id";
                    $result2 = $db->query($sql);

                    // Almaceno en la variable asignatura todas sus materias
                    while ($row = $result2->fetch(PDO::FETCH_ASSOC)) {
                        $asignatura .= $row['asignatura'] . " ";
                    }

                    // Si el id NO esta en el array, quiere decir que lo puedo poner
                    if (!in_array($id, $existentes)) {
                        array_push($existentes, $id);
                        echo "<option value='$id'>$nombre $apellido ($asignatura)</option>";
                    }
                }
            }
        }
    }

    static public function modificar($db, $nombre, $apellido, $password, $passwordValidate)
    {
        $error = false;
        $success = false;

        // Obtengo sus datos actuales
        $nombreActual = $_SESSION['nombre'];
        $apellidoActual = $_SESSION['apellido'];
        $id = $_SESSION['id'];

        // Actualizo el nombre
        if ($nombreActual !== $nombre) {
            $sql = "UPDATE alumno SET nombre = '$nombre' WHERE id = $id";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            $_SESSION['nombre'] = $nombre;
        }

        // Actualizo el apellido
        if ($apellidoActual !== $apellido) {
            $sql = "UPDATE alumno SET apellido = '$apellido' WHERE id = $id";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            $_SESSION['apellido'] = $apellido;
        }

        // Actualizo la contraseña
        if($password === $passwordValidate && strlen($password) >= 6) {
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);

            $sql = "UPDATE alumno SET contrasena = '$passwordHash' WHERE id = $id";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            $success = true; 
        }

        // Las contraseñas no coinciden
        if($password !== $passwordValidate) {
            $error = true;
        }

        // Si los datos no coinciden
        if($error) {
            header('Location: /Alumno/internal/perfil.php?error=true');
            return;
        } 

        // Si se cambio bien la contraseña
        if($success) {
            header('Location: /Alumno/internal/perfil.php?success=true');
            return;
        }

        // Llega aca si solo queria cambiar nombre o apellido
        header('Location: /Alumno/internal/perfil.php');
     
    }
}
