<?php


class Sistema
{
    static public function revisarAdministrador(string $usuario, string $contrasena, PDO $db): bool
    {
        $sql = "SELECT * FROM administrador WHERE usuario = '$usuario' LIMIT 1";
        $resultado = $db->query($sql);

        // Si hay un resultado, compruebo la contraseña
        while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
            $coinciden = password_verify($contrasena, $row['contrasena']);
            if ($coinciden) {
                // Inicio sesión
                session_start();
                $_SESSION['id'] = $row['id'];
                $_SESSION['sesion_admin'] = true;
                $_SESSION['usuario'] = $row['usuario'];
                $_SESSION['imagen'] = $row['imagen'];
                header('Location: /AppAdmin/index.php');
                return true;
            }
        }

        // No encontro un administrador
        return false;
    }

    static public function revisarDocente(string $cedula, string $contrasena, PDO $db): bool
    {
        $sql = "SELECT * FROM docente WHERE CI = '$cedula' LIMIT 1";

        $resultado = $db->query($sql);

        // Si hay un resultado, compruebo la contraseña
        while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
            $coinciden = password_verify($contrasena, $row['contrasena']);

            if ($coinciden) {
                // Inicio sesión 
                session_start();
                $_SESSION['id'] = $row['id'];
                $_SESSION['sesion_docente'] = true;
                $_SESSION['nombre'] = $row['nombre'];
                $_SESSION['apellido'] = $row['apellido'];
                $_SESSION['imagen'] = $row['imagen'];


                // Id para pasar vía GET
                $id = $row['id'];
                $name = $row['nombre'];

                if ($row['primer_login'] === '1') {
                    header("Location: ../welcome/docente.php?id=$id&name=$name");
                } else {
                    header('Location: /AppDocente/index.php');
                }

                return true;
            }
        }

        // No encontro el docente
        return false;
    }

    static public function revisarAlumno(string $cedula, string $contrasena, PDO $db): bool
    {
        $sql = "SELECT * FROM alumno WHERE CI = '$cedula' LIMIT 1";

        $resultado = $db->query($sql);

        // Si hay un resultado, compruebo la contraseña
        while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
            $coinciden = password_verify($contrasena, $row['contrasena']);

            if ($coinciden) {
                session_start();
                $_SESSION['id'] = $row['id'];
                $_SESSION['sesion_alumno'] = true;
                $_SESSION['nombre'] = $row['nombre'];
                $_SESSION['apellido'] = $row['apellido'];
                $_SESSION['imagen'] = $row['imagen'];

                // Id para pasar vía GET
                $id = $row['id'];
                $name = $row['nombre'];

                if ($row['primer_login'] === '1') {
                    header("Location: ../welcome/alumno.php?id=$id&name=$name");
                } else {
                    header('Location: /AppAlumno/index.php');
                }

                return true;
            }
        }

        // No encontro el alumno
        return false;
    }

    static public function errorHorario($idDocente, $db)
    {
        // Obtengo los datos del horario del profe
        $diaMinimo = '';
        $diaMaximo = '';
        $horaMinima = '';
        $horaMaxima = '';

        $sqlHorarios = "SELECT dia_minimo, dia_maximo, hora_minima, hora_maxima FROM docente WHERE id = $idDocente";
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
        $sql = "SELECT * FROM consultas_docente
        WHERE estado = 'contestada' AND titulo LIKE '%$consulta%'";
        $result = $db->query($sql);

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $idDocente = $row['idDocente'];
            $idAlumno = $row['idAlumno'];

            $nombreDocente = '';
            $apellidoDocente = '';
            $nombreAlumno = '';
            $apellidoAlumno = '';

            $sqlDocente = "SELECT nombre, apellido FROM docente WHERE id = $idDocente";
            $resultDocente = $db->query($sqlDocente);

            while ($docente = $resultDocente->fetch(PDO::FETCH_ASSOC)) {
                $nombreDocente = $docente['nombre'];
                $apellidoDocente = $docente['apellido'];
            }

            $sqlAlumno = "SELECT nombre, apellido FROM alumno WHERE id = $idAlumno";
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

        if (!empty($resultados)) {
            return $resultados;
        }

        return false;
    }

    public static function cargarAsignaturas($db)
    {
        $sql = "SELECT nombre FROM asignaturas";
        $result = $db->query($sql);

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $asignatura = $row['nombre'];
            echo "<option value='$asignatura'>$asignatura</option>";
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

       // TEMPORAL
       static public function crearAdmin($db)
       {
           $passwordHash = password_hash('esibuceo', PASSWORD_BCRYPT);
           $sql = "INSERT INTO administrador (usuario,contrasena,imagen) VALUES ('admin', '$passwordHash','/build/public/Admin.svg')";
           $db->query($sql);
       }

      // FIN TEMPORAL
   
}
