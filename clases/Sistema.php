<?php


class Sistema {
    static public function revisarAdministrador(string $usuario, string $contrasena, object $db) : bool {
        $sql = "SELECT * FROM administrador WHERE usuario = '$usuario' LIMIT 1";
        $resultado = $db->query($sql);

        // Si hay un resultado, compruebo la contraseña
        while($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
            $coinciden = password_verify($contrasena, $row['contrasena']);
            if($coinciden) {
                // Inicio sesión
                session_start();
                $_SESSION['id'] = $row['id'];
                $_SESSION['sesion_admin'] = true;
                $_SESSION['usuario'] = $row['usuario'];
                $_SESSION['imagen'] = $row['imagen'];
                header('Location: /Administrador/index.php');
                return true;
            } 
        }

        // No encontro un administrador
        return false;
       
    }

    static public function revisarDocente(string $cedula, string $contrasena, object $db) : bool {
        $sql = "SELECT * FROM Docente WHERE CI = '$cedula' LIMIT 1";

        $resultado = $db->query($sql);

        // Si hay un resultado, compruebo la contraseña
        while($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
            $coinciden = password_verify($contrasena, $row['contrasena']);
        
            if($coinciden) {
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

                if($row['primer_login'] === '1') {
                    header("Location: ../welcome/docente.php?id=$id&name=$name");
                } else {
                    header('Location: /Docente/index.php');
                }

                return true;
            } 
        }

        // No encontro el docente
        return false;
    }

    static public function revisarAlumno(string $cedula, string $contrasena, object $db) : bool {
        $sql = "SELECT * FROM Alumno WHERE CI = '$cedula' LIMIT 1";

        $resultado = $db->query($sql);

        // Si hay un resultado, compruebo la contraseña
        while($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
            $coinciden = password_verify($contrasena, $row['contrasena']);
        
            if($coinciden) {
                session_start();
                $_SESSION['id'] = $row['id'];
                $_SESSION['sesion_alumno'] = true;
                $_SESSION['nombre'] = $row['nombre'];
                $_SESSION['apellido'] = $row['apellido'];
                $_SESSION['imagen'] = $row['imagen'];

                 // Id para pasar vía GET
                 $id = $row['id'];
                 $name = $row['nombre'];
 
                 if($row['primer_login'] === '1') {
                     header("Location: ../welcome/alumno.php?id=$id&name=$name");
                 } else {
                     header('Location: /Alumno/index.php');
                 }

                return true;
            }
        }

        // No encontro el alumno
        return false;

    }

    static public function crearAdmin($db) {
        $passwordHash = password_hash('esibuceo', PASSWORD_BCRYPT);
        $sql = "INSERT INTO administrador (usuario,contrasena,imagen) VALUES ('admin', '$passwordHash','/build/public/Admin.svg')";
        $db->query($sql);
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

}