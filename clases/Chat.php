<?php

class Chat
{

    public static function datosDocente($asignatura, $grupo, $db)
    {
        $idDocente = '';
        $nombreDocente = '';
        $apellidoDocente = '';

        // Obtengo los datos del profesor de esa asignatura en el grupo
        $sql  = "SELECT DISTINCT id, nombre, apellido
         FROM docente
         INNER JOIN grupos_docente
         ON grupos_docente.idDocente = docente.id AND grupo = '$grupo'
         INNER JOIN asignaturas_docente as asignaturas
         ON docente.id = asignaturas.idDocente AND asignatura = '$asignatura'";

        $result = $db->query($sql);
        // Recorro los datos del docente
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $idDocente = Chat::getIdDocente($row['id'], $db);
            $nombreDocente = $row['nombre'];
            $apellidoDocente = $row['apellido'];
        }

        $datosDocente = [
            "idDocente" => $idDocente,
            "nombreDocente" => $nombreDocente,
            "apellidoDocente" => $apellidoDocente,
        ];


        return $datosDocente;
    }

    public static function revisarExistencia($idDocente, $asignatura, $db)
    {

        if (empty($idDocente)) {
            header('Location: ../crear.php?empty=true');
        }

        $sqlExistencia = "SELECT * FROM chat WHERE asignatura = '$asignatura' AND idDocente = $idDocente";
        $resultado = $db->query($sqlExistencia);

        while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
            header('Location: ../crear.php?created=true');
            return true;
        }

        return false;
    }

    public static function crearChat($datosAlumno, $datosDocente, $grupo, $db)
    {
        $asignatura = $_POST['asignatura'];
        $idHost = Chat::getIdAlumno($datosAlumno['idAlumno'], $db);
        $nombreHost = $datosAlumno['nombreAlumno'];
        $apellidoHost = $datosAlumno['apellidoAlumno'];

        $idDocente = $datosDocente['idDocente'];
        $nombreDocente = $datosDocente['nombreDocente'];
        $apellidoDocente = $datosDocente['apellidoDocente'];

        $sql = "INSERT INTO chat (idHost, nombreHost, apellidoHost, idDocente, nombreDocente, apellidoDocente, asignatura, grupo) 
                VALUES
                 ($idHost, '$nombreHost', '$apellidoHost', $idDocente, '$nombreDocente', '$apellidoDocente', '$asignatura', '$grupo')";

        $stmt = $db->prepare($sql);

        if ($stmt->execute()) {
            return $datosChat = [
                "asignatura" => $asignatura,
                "idHost" => $idHost,
                "nombreHost" => $nombreHost,
                "apellidoHost" => $apellidoHost,
                "idDocente" => $idDocente,
                "nombreDocente" => $nombreDocente,
                "apellidoDocente" => $apellidoDocente

            ];
        }
    }

    public static function getIdAlumno($id, $db)
    {
        $ci = '';

        $sql = "SELECT CI FROM alumno WHERE id = $id";
        $result = $db->query($sql);

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $ci = $row['CI'];
        }

        $sql = "SELECT id FROM usuarios WHERE ci = '$ci'";
        $result = $db->query($sql);

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            return $row['id'];
        }
    }

    public static function getIdDocente($id, $db)
    {
        $ci = '';

        $sql = "SELECT CI FROM docente WHERE id = $id";
        $result = $db->query($sql);

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $ci = $row['CI'];
        }

        $sql = "SELECT id FROM usuarios WHERE ci = '$ci'";
        $result = $db->query($sql);

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            return $row['id'];
        }
    }

    public static function getDatos($idChat, $db)
    {
        $sql = "SELECT * FROM chat WHERE id = $idChat";
        $result = $db->query($sql);

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $idChat = $row['id'];
            $idHost = $row['idHost'];
            $nombreHost = $row['nombreHost'];
            $apellidoHost = $row['apellidoHost'];
            $idDocente = $row['idDocente'];
            $nombreDocente = $row['nombreDocente'];
            $apellidoDocente = $row['apellidoDocente'];
            $asignatura = $row['asignatura'];
        }

        return [
            "idChat" => $idChat,
            "idHost" => $idHost,
            "nombreHost" => $nombreHost,
            "apellidoHost" => $apellidoHost,
            "idDocente" => $idDocente,
            "nombreDocente" => $nombreDocente,
            "apellidoDocente" => $apellidoDocente,
            "asignatura" => $asignatura
        ];
    }

    public static function enviarMensaje($idChat, $idUsuario, $nombre, $apellido,  $mensaje, $db)
    {
        if (!empty($mensaje)) {
            $mensaje = $db->quote($mensaje); // Evito que caracteres como comillas den error en el query
            $sql = "INSERT INTO mensajes_chat (idChat, idUsuario, nombreUsuario, apellidoUsuario, mensaje) VALUES ($idChat, $idUsuario, '$nombre', '$apellido', $mensaje)";

            $stmt = $db->prepare($sql);
            $stmt->execute();
        }
    }

    public static function cargarUsuarios($idChat, $db)
    {
        $sql = "SELECT nombreUsuario, apellidoUsuario FROM usuarios_chat WHERE idChat = $idChat";
        $result = $db->query($sql);

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $nombreUsuario = $row['nombreUsuario'];
            $apellidoUsuario = $row['apellidoUsuario'];

            echo "<div class='user'>";
                echo "<i id='student' class='fas fa-graduation-cap'></i>";
                echo "<p> $nombreUsuario  $apellidoUsuario </p>";
                
                 echo "<div class='online'>";
                    echo " <i id='status-online' class='fas fa-circle'></i>";
                echo "</div>";
            echo "</div>";
        }
    }

    public static function cargarHost($idChat, $db)
    {
        $sql = "SELECT nombreHost, apellidoHost FROM chat WHERE id = $idChat";
        $result = $db->query($sql);

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $nombreHost = $row['nombreHost'];
            $apellidoHost = $row['apellidoHost'];

            echo "<div class='user'>";
                echo "  <i id='crown' class='fas fa-crown'></i>";
                echo "<p> $nombreHost  $apellidoHost </p>";
                
                 echo "<div class='online'>";
                    echo " <i id='status-online' class='fas fa-circle'></i>";
                echo "</div>";
            echo "</div>";
        }
    }
}
