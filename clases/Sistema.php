<?php


class Sistema
{

    static public function revisarUsuario(string $cedula, string $contrasena, PDO $db)
    {
        $entroCI = false;
        $errorPass = false;

        $sql = "SELECT * FROM usuario WHERE CI = '$cedula' LIMIT 1";
        $resultado = $db->query($sql);

        // Si hay un resultado, compruebo la contraseña
        while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
            $entroCI = true;
            $coinciden = password_verify($contrasena, $row['contrasena']);

            !$coinciden ? $errorPass = true : false;

            if ($coinciden) {
                // Inicio sesión 
                session_start();
                $_SESSION['id'] = $row['id'];
                $_SESSION['CI'] = $row['CI'];
                $_SESSION['nombre'] = $row['nombre'];
                $_SESSION['apellido'] = $row['apellido'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['tipo'] = $row['tipo'];
                $_SESSION['imagen'] = $row['imagen'];

                // Id para pasar vía GET
                $tipo =  $row['tipo'];
                $id = $row['id'];
                $name = $row['nombre'];

                switch ($tipo) {
                    case 'alumno':
                        $_SESSION['sesion_alumno'] = true;

                        if ($row['primer_login'] === '1') {
                            header("Location: ../welcome/alumno.php?id=$id&name=$name");
                        } else {
                            header('Location: /AppAlumno/index.php');
                        }

                        return true;
                        break;
                    case 'docente':
                        $_SESSION['sesion_docente'] = true;

                        if ($row['primer_login'] === '1') {
                            header("Location: ../welcome/docente.php?id=$id&name=$name");
                        } else {
                            header('Location: /AppDocente/index.php');
                        }
                        return true;
                        break;
                    case 'admin':
                        $_SESSION['sesion_admin'] = true;
                        header('Location: /AppAdmin/index.php');
                        return true;
                        break;
                }
            }
        }

        // No encontro el usuario
        $errorCI = false;

        !$entroCI ? $errorCI = true : null;

        return [
            'errorCI' => $errorCI,
            'errorPass' => $errorPass
        ];
    }

    static public function revisarCedula(string $cedula, PDO $db): bool
    {
        $sql = "SELECT * FROM cedulas WHERE cedula = '$cedula' ";
        $resultado = $db->query($sql);

        // Si entra en el while es porque encontró una cedula
        while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
            return true;
        }

        return false;
    }


    static public function revisarMail(string $email, PDO $db): bool
    {
        if(!is_string($email)) return false;

        $sql = "SELECT * FROM usuario WHERE email = '$email'";
        $resultado = $db->query($sql);

        // Si entra en el while es porque encontró un email
        while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
            return true;
        }

        return false;
    }

    static public function errorHorario($idDocente, $db)
    {
        // Obtengo los datos del horario del profe
        $diaMinimo = '';
        $diaMaximo = '';
        $horaMinima = '';
        $horaMaxima = '';
        $ciDocente = '';

        $sql = "SELECT CI FROM usuario WHERE id = $idDocente";
        $resultado = $db->query($sql);

        while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
            $ciDocente = $row['CI'];
        }

        $sqlHorarios = "SELECT dia_minimo, dia_maximo, hora_minima, hora_maxima FROM horarios WHERE ciDocente = '$ciDocente'";
        $resultadoHorarios = $db->query($sqlHorarios);

        // Iterar resultados;
        while ($datos = $resultadoHorarios->fetch(PDO::FETCH_ASSOC)) {
            $diaMinimo = $datos['dia_minimo'];
            $diaMaximo = $datos['dia_maximo'];
            $horaMinima = $datos['hora_minima'];
            $horaMaxima = $datos['hora_maxima'];
        }

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

    static public function buscarConsulta($consulta, $db)
    {
        $resultados = [];
        $sql = "SELECT * FROM consultas WHERE titulo LIKE '%$consulta%'";

        $result = $db->query($sql);

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

            if ($row['respuesta']) {
                $idDocente = $row['idDocente'];
                $idAlumno = $row['idAlumno'];

                $nombreDocente = '';
                $apellidoDocente = '';
                $nombreAlumno = '';
                $apellidoAlumno = '';

                $sqlDocente = "SELECT nombre, apellido FROM usuario WHERE id = $idDocente";
                $resultDocente = $db->query($sqlDocente);

                while ($docente = $resultDocente->fetch(PDO::FETCH_ASSOC)) {
                    $nombreDocente = $docente['nombre'];
                    $apellidoDocente = $docente['apellido'];
                }

                $sqlAlumno = "SELECT nombre, apellido FROM usuario WHERE id = $idAlumno";
                $resultAlumno = $db->query($sqlAlumno);

                while ($alumno = $resultAlumno->fetch(PDO::FETCH_ASSOC)) {
                    $nombreAlumno = $alumno['nombre'];
                    $apellidoAlumno = $alumno['apellido'];
                }


                $resultados[] =  [
                    'id' => $row['id'],
                    'nombreAlumno' => $nombreAlumno,
                    'apellidoAlumno' => $apellidoAlumno,
                    'nombreDocente' => $nombreDocente,
                    'apellidoDocente' => $apellidoDocente,
                    'titulo' => $row['titulo'],
                    'descripcion' => $row['descripcion'],
                    'respuesta' => $row['respuesta'],
                    'fecha' => $row['fecha'],
                ];
            }
        }

        if (!empty($resultados)) {
            return $resultados;
        }

        return false;
    }

    public static function cargarAsignaturas($db)
    {
        $sql = "SELECT * FROM asignaturas";
        $result = $db->query($sql);

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $asignatura = $row['nombre'];
            $grado = $row['grado'];

            switch ($grado) {
                case '1':
                    $grado = 'I';
                    break;
                case '2':
                    $grado = 'II';
                    break;
                case '3':
                    $grado = 'III';
                    break;
            }

            echo "<option value='$asignatura'>$asignatura $grado</option>";
        }
    }

    public static function cargarAsignaturasYorientacion($db)
    {
        $sql = "SELECT nombre, orientacion, grado FROM asignaturas";
        $result = $db->query($sql);

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $asignatura = $row['nombre'];
            $orientacion = $row['orientacion'];
            $grado = $row['grado'];
            echo "<option value='$asignatura, $orientacion, $grado'>$asignatura de $grado ($orientacion)</option>";
        }
    }

    public static function cargarOrientaciones($db)
    {
        $sql = "SELECT orientacion FROM orientaciones_sistema";
        $result = $db->query($sql);

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $orientacion = $row['orientacion'];
            echo "<option value='$orientacion'>$orientacion</option>";
        }
    }

    public static function cargarGrupos($db)
    {
        $sql = "SELECT grupo FROM grupos_sistema";
        $result = $db->query($sql);

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $grupo = $row['grupo'];
            echo "<option value='$grupo'>$grupo</option>";
        }
    }

    public static function formatearGrupos($grupos, $db): array
    {
        $gruposFormateados = [];
        // Le agrego un caracter de grupos
        foreach ($grupos as $grupo) {

            $numero = $grupo[0];
            $letra1 = $grupo[1];
            $letra2 = $grupo[2];

            $format = $numero . "º" . $letra1 . $letra2;
            $gruposFormateados[] = $format;
        }

        return $gruposFormateados;
    }
}
