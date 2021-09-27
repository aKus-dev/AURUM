<?php

class Administrador // Falta implementar la interface
{
    private $id;
    private $usuario;
    private $contrasena;
    private $imagen;

    // Constructor una vez inicia sesión
    public function __construct(int $id, string $usuario, string $contrasena, string $imagen)
    {
        $this->id = $id;
        $this->usuario = $usuario;
        $this->contrasena = $contrasena;
        $this->imagen = $imagen;
    }

    static public function altaUsuario(array $datos, $tipo, PDO $db)
    {
        $CI = $datos['ci'];
        $nombre = $datos['nombre'];
        $apellido = $datos['apellido'];
        $contrasena = $datos['contrasena'];
        $email = $datos['email'];
        $grupos = $datos['grupos'];
        $asignaturas = $datos['asignaturas'] ?? null;
        $imagen = '/build/public/Alumno_1.svg';

        // Hashear password
        $passwordHash = password_hash($contrasena, PASSWORD_BCRYPT);

        // Codigo SQL
        if ($tipo === 'alumno') {
            $sql = "INSERT INTO usuario (CI,nombre,apellido, email, contrasena, imagen, tipo, primer_login) 
                    VALUES ('$CI', '$nombre', '$apellido', '$email', '$passwordHash', '$imagen', 'alumno', true)";

            $stmt = $db->prepare($sql); // prepare() optimiza el query y evita inyecciones no validas
            $stmt->execute(); // Lo ejecuta

            // REGISTRO SUS GRUPOS
            $sql = "SELECT id FROM usuario WHERE CI = '$CI' LIMIT 1";
            $resultado = $db->query($sql);

            // Iterar resultados;
            while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
                foreach ($grupos as $grupo) {
                    $idAlumno = $row['id'];
                    $sql = "INSERT INTO grupos_alumno VALUES ($idAlumno, '$grupo')";

                    $stmt = $db->prepare($sql);
                    $stmt->execute();
                }
            }
        } else {
            $sql = "INSERT INTO usuario (CI,nombre,apellido, email, contrasena, imagen, tipo, primer_login) 
                    VALUES ('$CI', '$nombre', '$apellido', '$email', '$passwordHash', '$imagen', 'docente', true)";

            $stmt = $db->prepare($sql); // prepare() optimiza el query y evita inyecciones no validas
            $stmt->execute(); // Lo ejecuta

            // REGISTRO SUS GRUPOS
            $sql = "SELECT id FROM usuario WHERE CI = '$CI' LIMIT 1";
            $resultado = $db->query($sql);

            // Iterar resultados;
            while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
                foreach ($grupos as $grupo) {
                    $idDocente = $row['id'];
                    $sql = "INSERT INTO grupos_docente VALUES ($idDocente, '$grupo')";

                    $stmt = $db->prepare($sql);
                    $stmt->execute();
                }

                foreach ($asignaturas as $asignatura) {
                    $idDocente = $row['id'];
                    $sql = "INSERT INTO asignaturas_docente  VALUES ($idDocente, '$asignatura')";

                    $stmt = $db->prepare($sql);
                    $stmt->execute();
                }
            }
        }


        return true; // Si todo esta correcto, retornamos true
    }


    static public function eliminarUsuario(string $cedula, PDO $db)
    {
        $encontrado = false;
        $sql = "SELECT * FROM usuario WHERE CI= '$cedula'";
        $resultado = $db->query($sql);

        // Iterar resultados;
        while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
            $encontrado = true;
        }

        if ($encontrado) {
            $sql = "DELETE FROM usuario WHERE CI= '$cedula' ";
            $stmt = $db->prepare($sql); // prepare() optimiza el query y evita inyecciones no validas
            $stmt->execute(); // Lo ejecuta
            return true;
        }

        return false;
    }

    static public function modificarUsuario(array $datos, $tipo, PDO $db)
    {
        $id = $datos['id'];
        $nombre = $datos['nombre'];
        $apellido = $datos['apellido'];
        $password = $datos['contrasena'];
        $email = $datos['email'];
        $grupos = $datos['grupos'] ?? null;
        $asignaturas = $datos['asignaturas'] ?? null;

        // Actualizo el nombre
        $db->query("UPDATE usuario SET nombre = '$nombre' WHERE id = $id");
        // Actualizo el apellido
        $db->query("UPDATE usuario SET apellido = '$apellido' WHERE id = $id");

        // Si cambió la contraseña la actualizo
        if (!empty($password)) {
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);
            $db->query("UPDATE usuario SET contrasena = '$passwordHash' WHERE id = $id");
        }

        // Si cambió el email lo actualizo
        if (!empty($email)) {
            $db->query("UPDATE usuario SET email = '$email' WHERE id = $id");
        }

        // Actualizo los grupos
        if (!empty($grupos) && $tipo === 'alumno') {
            $db->query("DELETE FROM grupos_alumno WHERE idAlumno = $id");

            foreach ($grupos as $grupo) {
                $db->query("INSERT INTO grupos_alumno VALUES ($id, '$grupo')");
            }
        }

        if (!empty($grupos) && $tipo === 'docente') {
            $db->query("DELETE FROM grupos_docente WHERE idDocente = $id");

            foreach ($grupos as $grupo) {
                $db->query("INSERT INTO grupos_docente VALUES ($id, '$grupo')");
            }
        }

        if (!empty($asignaturas) && $tipo === 'docente') {
            $db->query("DELETE FROM asignaturas_docente WHERE idDocente = $id");

            foreach ($asignaturas as $asignatura) {
                $db->query("INSERT INTO asignaturas_docente VALUES ($id, '$asignatura')");
            }
        }

        return true;
    }


    static public function getDatosUsuario(string $cedula, PDO $db)
    {
        $encontrado = false;
        $sql = "SELECT * FROM usuario WHERE CI= '$cedula'";
        $resultado = $db->query($sql);

        // Iterar resultados;
        while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
            return $row; // Retorno los datos
        }

        return false;
    }

    static public function altaGrupo(string $grupo, PDO $db)
    {
        $sql = "INSERT INTO grupos_sistema (grupo) VALUES ('$grupo')";
        $stmt = $db->prepare($sql); 
        return $stmt->execute(); 
    }

    static public function altaOrientacion(string $orientacion, PDO $db)
    {
        $sql = "INSERT INTO orientaciones_sistema (orientacion) VALUES ('$orientacion')";
        $stmt = $db->prepare($sql); 
        return $stmt->execute(); 

    }

    static public function altaAsignatura(string $asignatura, $orientacion, $grado, PDO $db)
    {
        $sql = "INSERT INTO asignaturas (nombre,orientacion, grado) VALUES ('$asignatura', '$orientacion', $grado)";
        $stmt = $db->prepare($sql); 
        return $stmt->execute(); 

    }

    static public function bajaAsignatura(string $asignatura, PDO $db)
    {
        $sql = "DELETE FROM asignaturas WHERE nombre = '$asignatura'";
        $stmt = $db->prepare($sql);
        return $stmt->execute(); 
    }

    static public function modificarAsignatura(string $asignatura_vieja, $asignatura_nueva, PDO $db)
    {
        $sql = "UPDATE asignaturas SET nombre = '$asignatura_nueva' WHERE nombre = '$asignatura_vieja'";
        $stmt = $db->prepare($sql);
        return $stmt->execute(); 
    }
}
