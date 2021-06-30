<?php


class Sistema {
    static public function revisarAdministrador(string $usuario, string $contrasena, object $db) : bool {
        $sql = "SELECT * FROM Administrador WHERE usuario = '$usuario' LIMIT 1";

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
                $_SESSION['grupo'] = $row['grupo'];
                $_SESSION['asignatura'] = $row['asignatura'];
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
                $_SESSION['grupo'] = $row['grupo'];
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
        $sql = "INSERT INTO Administrador (usuario,contrasena,imagen) VALUES ('admin', '$passwordHash','null')";
        $db->query($sql);
    }
}