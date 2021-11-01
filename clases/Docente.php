<?php

class Docente
{
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

    static public function crear(array $datos, PDO $db): bool
    {

        $CI = $datos['ci'];
        $nombre = $datos['nombre'];
        $apellido = $datos['apellido'];
        $grupos = $datos['grupos'];
        $asignaturas = $datos['asignaturas'];
        $contrasena = $datos['contrasena'];
        $email = $datos['email'];
        $imagen = '/build/public/Profesor_1.svg';


        // Hashear password
        $passwordHash = password_hash($contrasena, PASSWORD_BCRYPT);;

        // Codigo SQL
        $sql = "INSERT INTO usuario (CI,nombre,apellido, email, contrasena, imagen, tipo, primer_login) VALUES 
        ('$CI', '$nombre', '$apellido', '$email', '$passwordHash', '$imagen', 'docente', true)";

        $stmt = $db->prepare($sql); // prepare() optimiza el query y evita inyecciones no validas
        if ($stmt->execute()) { // Lo ejecutamos

            // Guardo la cedula en la tabla horarios
            $sql = "INSERT INTO horarios (ciDocente, registro_horarios) VALUES ('$CI', false)";
            $db->query($sql);

            // Guardo la cedula en la tabla de cedulas
            $sql = "INSERT INTO cedulas (cedula) VALUES ('$CI') ";
            $db->query($sql);

            // Registro las asignaturas
            self::registrarAsignaturas($asignaturas, $CI, $db);
            // Registro los grupos
            self::registrarGrupos($grupos, $CI, $db);


            return true; // Si todo esta correcto, retornamos true
        } 
    }

    static public function registrarAsignaturas($asignaturas, $CI, $db)
    {
        $sql = "SELECT id FROM usuario WHERE ci = '$CI' LIMIT 1";

        $resultado = $db->query($sql);

        // Iterar resultados;
        while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
            foreach ($asignaturas as $asignatura) {
                $asignaturaDecode = $asignatura; // Para que guarde con tildes y Ñ en la base de datos

                $idDocente = $row['id'];
                $sql = "INSERT INTO asignaturas_docente VALUES ($idDocente, '$asignaturaDecode')";

                $stmt = $db->prepare($sql);
                $stmt->execute();
            }
        }
    }

    static public function registrarGrupos($grupos, $CI, $db)
    {
        $sql = "SELECT id FROM usuario WHERE ci = '$CI' LIMIT 1";

        $resultado = $db->query($sql);

        // Iterar resultados;
        while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
            foreach ($grupos as $grupo) {
                $idDocente = $row['id'];
                $sql = "INSERT INTO grupos_docente VALUES ($idDocente, '$grupo')";

                $stmt = $db->prepare($sql);
                $stmt->execute();
            }
        }
    }

    static public function responderConsulta($idConsulta, $respuesta, PDO $db)
    {
        // Escapo las comillas para que no tire error
        $respuesta = $db->quote($respuesta);   

        // Actualiza la consulta en los docentes
        $sql =  "UPDATE consultas SET respuesta = $respuesta WHERE id=$idConsulta;";
        $stmt = $db->prepare($sql);
        $stmt->execute();

        $sql = "UPDATE consultas SET estado = 'contestada' WHERE id=$idConsulta;";
        $stmt = $db->prepare($sql);
        $stmt->execute();

        header("Location: /AppDocente/internal/consultas.php?success=true&type=enviada");
    }

    static public function modificar($db, $nombre, $apellido, $password, $passwordValidate, $imagen)
    {
        $error = false;
        $success = false;

        // Obtengo sus datos actuales
        $nombreActual = $_SESSION['nombre'];
        $apellidoActual = $_SESSION['apellido'];
        $id = $_SESSION['id'];

        // Actualizo la imagen
        if ($imagen !== '') {
            $sql = "UPDATE usuario SET imagen = '$imagen' WHERE id = $id";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            $_SESSION['imagen'] = $imagen;
        }

        // Actualizo el nombre
        if ($nombreActual !== $nombre) {
            $sql = "UPDATE usuario SET nombre = '$nombre' WHERE id = $id";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            $_SESSION['nombre'] = $nombre;
        }

        // Actualizo el apellido
        if ($apellidoActual !== $apellido) {
            $sql = "UPDATE usuario SET apellido = '$apellido' WHERE id = $id";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            $_SESSION['apellido'] = $apellido;
        }

        // Actualizo la contraseña
        if ($password === $passwordValidate && strlen($password) >= 6) {
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);

            $sql = "UPDATE usuario SET contrasena = '$passwordHash' WHERE id = $id";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            $success = true;
        }

        // Las contraseñas no coinciden
        if ($password !== $passwordValidate) {
            $error = true;
        }

        // Si los datos no coinciden
        if ($error) {
            header('Location: /AppDocente/internal/perfil.php?error=true');
            return;
        }

        // Si se cambio bien la contraseña
        if ($success) {
            header('Location: /AppDocente/internal/perfil.php?success=true');
            return;
        }

        // Llega aca si solo queria cambiar nombre o apellido
        header('Location: /AppDocente/internal/perfil.php');
    }

    public static function eliminarDocente($idDocente, $db) {
        $sql = "SELECT CI FROM usuario WHERE id = $idDocente";
        $resultado = $db->query($sql);

        $cedula = '';

        while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
            $cedula = $row['CI'];
        }

        // Elimino de la tabla cedulas
        $sql = "DELETE FROM cedulas WHERE cedula = $cedula";
        $db->query($sql);

        // Elimino el docente
        $sql = "DELETE FROM usuario WHERE id = $idDocente";
        $db->query($sql);

        header('Location: /index.html');
        
    }

    static public function revisarHorarios($idDocente, $db) {
        $sql = "SELECT CI FROM usuario WHERE id = $idDocente";
        $resultado = $db->query($sql);

        $cedula = '';

        while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
            $cedula = $row['CI'];
        }

        $sql = "SELECT registro_horarios FROM horarios WHERE ciDocente = '$cedula'";
        $resultado = $db->query($sql);
        while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
            $registro_horarios = $row['registro_horarios'];
        }

        if(!$registro_horarios) {
            header('Location: ./horarios.php');
        }
    }

    public static function getHorarios($ciDocente, $db) {
        $diaMinimo = '';
        $diaMaximo = '';
        $horaMinima = '';
        $horaMaxima = '';

        // Obtengo los datos del horario del profe
        $sqlHorarios = "SELECT dia_minimo, dia_maximo, hora_minima, hora_maxima FROM horarios WHERE ciDocente = '$ciDocente'";
        $resultadoHorarios = $db->query($sqlHorarios);

        // Iterar resultados;
        while ($datos = $resultadoHorarios->fetch(PDO::FETCH_ASSOC)) {
            $diaMinimo = $datos['dia_minimo'];
            $diaMaximo = $datos['dia_maximo'];
            $horaMinima = $datos['hora_minima'];
            $horaMaxima = $datos['hora_maxima'];
        }

        if(!empty($diaMinimo) && !empty($diaMaximo) &&  !empty($horaMinima) &&  !empty($horaMaxima)) {
            switch ($diaMinimo) {
                case 1:
                    $diaMinimo = "lunes";
                    break;
                case 2:
                    $diaMinimo = "martes";
                    break;
                case 3:
                    $diaMinimo = "miércoles";
                    break;
                case 4:
                    $diaMinimo = "jueves";
                    break;
                case 5:
                    $diaMinimo = "viernes";
                    break;
                case 6:
                    $diaMinimo = "sábado";
                    break;
                case 7:
                    $diaMinimo = "domingo";
                    break;
            }
    
    
            switch ($diaMaximo) {
                case 1:
                    $diaMaximo = "lunes";
                    break;
                case 2:
                    $diaMaximo = "martes";
                    break;
                case 3:
                    $diaMaximo = "miércoles";
                    break;
                case 4:
                    $diaMaximo = "jueves";
                    break;
                case 5:
                    $diaMaximo = "viernes";
                    break;
                case 6:
                    $diaMaximo = "sábado";
                    break;
                case 7:
                    $diaMaximo = "domingo";
                    break;
            }
    
            return $datos = [
                "diaMinimo" => $diaMinimo,
                "diaMaximo" => $diaMaximo,
                "horaMinima" => $horaMinima,
                "horaMaxima" => $horaMaxima,
            ];
        }

        return false;

       

    }
}
