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
        $imagen = '/build/public/Profesor_1.svg';


        // Hashear password
        $passwordHash = password_hash($contrasena, PASSWORD_BCRYPT);

        $sqlUsuarios = "INSERT INTO usuarios (ci) VALUES ($CI)";
        $db->query($sqlUsuarios);

        // Codigo SQL
        $sql = "INSERT INTO docente (CI,nombre,apellido, contrasena, imagen, primer_login, registro_horarios) VALUES 
        ('$CI', '$nombre', '$apellido', '$passwordHash', '$imagen',  true, false)";

        $stmt = $db->prepare($sql); // prepare() optimiza el query y evita inyecciones no validas
        if ($stmt->execute()) { // Lo ejecutamos

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

    static public function registrarAsignaturas($asignaturas, $CI, $db)
    {
        $sql = "SELECT id FROM docente WHERE ci = '$CI' LIMIT 1";

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
        $sql = "SELECT id FROM docente WHERE ci = '$CI' LIMIT 1";

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


    static public function revisarExistencia(string $cedula, PDO $db): bool
    {
        $sql = "SELECT * FROM cedulas WHERE cedula = '$cedula' ";

        $resultado = $db->query($sql);

        // Si entra en el while es porque encontró una cedula
        while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
            return true;
        }

        return false;
    }

    static public function responderConsulta($idConsulta, $respuesta, PDO $db)
    {
        /* date_default_timezone_set("America/Montevideo");
        $fecha = date('Y-m-d'); */

        // Escapo las comillas para que no tire error
        $respuesta = $db->quote($respuesta);   

        // Actualiza la consulta en los docentes
        $sql =  "UPDATE consultas_docente SET respuesta = $respuesta WHERE id=$idConsulta;";
        $stmt = $db->prepare($sql);
        $stmt->execute();

        $sql = "UPDATE consultas_docente SET estado = 'contestada' WHERE id=$idConsulta;";
        $stmt = $db->prepare($sql);
        $stmt->execute();

        // Actualiza la consulta en la tabla de alumnos
        $sql = "UPDATE consultas_alumno SET estado = 'contestada' WHERE id=$idConsulta;";
        $stmt = $db->prepare($sql);
        $stmt->execute();

        $sql = "UPDATE consultas_alumno SET respuesta = $respuesta WHERE id=$idConsulta;";
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
            $sql = "UPDATE docente SET imagen = '$imagen' WHERE id = $id";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            $_SESSION['imagen'] = $imagen;
        }

        // Actualizo el nombre
        if ($nombreActual !== $nombre) {
            $sql = "UPDATE docente SET nombre = '$nombre' WHERE id = $id";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            $_SESSION['nombre'] = $nombre;
        }

        // Actualizo el apellido
        if ($apellidoActual !== $apellido) {
            $sql = "UPDATE docente SET apellido = '$apellido' WHERE id = $id";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            $_SESSION['apellido'] = $apellido;
        }

        // Actualizo la contraseña
        if ($password === $passwordValidate && strlen($password) >= 6) {
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);

            $sql = "UPDATE docente SET contrasena = '$passwordHash' WHERE id = $id";
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
        $sql = "SELECT CI FROM docente WHERE id = $idDocente";
        $resultado = $db->query($sql);

        $cedula = '';

        while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
            $cedula = $row['CI'];
        }

        // Elimino de la tabla cedulas
        $sql = "DELETE FROM cedulas WHERE cedula = $cedula";
        $db->query($sql);

        // Elimino el registro en la tabla usuario
        $sql = "DELETE FROM usuarios WHERE ci = $cedula";
        $db->query($sql);

        // Elimino el docente
        $sql = "DELETE FROM docente WHERE id = $idDocente";
        $db->query($sql);

        header('Location: /index.html');
        
    }

    static public function revisarHorarios($idDocente, $db) {
        $sql = "SELECT registro_horarios FROM docente WHERE id = $idDocente";
        $resultado = $db->query($sql);
        while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
            $registro_horarios = $row['registro_horarios'];
        }

        if(!$registro_horarios) {
            header('Location: ./horarios.php');
        }
    }

    public static function getHorarios($idDocente, $db) {
        $diaMinimo = '';
        $diaMaximo = '';
        $horaMinima = '';
        $horaMaxima = '';

        // Obtengo los datos del horario del profe
        $sqlHorarios = "SELECT dia_minimo, dia_maximo, hora_minima, hora_maxima FROM docente WHERE id = $idDocente";
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
