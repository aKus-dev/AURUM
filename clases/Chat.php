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
            $grupo = $row['grupo'];
        }

        return [
            "idChat" => $idChat,
            "idHost" => $idHost,
            "nombreHost" => $nombreHost,
            "apellidoHost" => $apellidoHost,
            "idDocente" => $idDocente,
            "nombreDocente" => $nombreDocente,
            "apellidoDocente" => $apellidoDocente,
            "asignatura" => $asignatura,
            "grupo" => $grupo
        ];
    }

    public static function enviarMensaje($idChat, $idUsuario, $nombre, $apellido,  $mensaje, $db)
    {
        date_default_timezone_set("America/Montevideo");
        $hora = Date('G:i');

        if (!empty($mensaje)) {
            $mensaje = $db->quote($mensaje); // Evito que caracteres como comillas den error en el query
            $sql = "INSERT INTO mensajes_chat (idChat, idUsuario, nombreUsuario, apellidoUsuario, mensaje, hora) 
            VALUES ($idChat, $idUsuario, '$nombre', '$apellido', $mensaje, '$hora')";

            $stmt = $db->prepare($sql);
            $stmt->execute();
        }
    }

    public static function offlineAlumno ($id, $db) {
        $id = self::getIdAlumno($id, $db);
        $chats = [];

        $result = $db->query("SELECT id FROM chat WHERE idHost = $id");

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $chats['host'][] = $row['id'];
        }

        $sql = "SELECT idChat  FROM usuarios_chat WHERE idUsuario = $id";
        $result = $db->query($sql);

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $chats['usuario'][] = $row['idChat'];
        }

        // Si esta en un chat de host
        if(!empty($chats['host'])) {

            // Paso a offline en los chats en los que es host
            foreach ($chats['host'] as $chat) {
                $sql = "UPDATE chat SET isOnlineHost = false WHERE id = $chat";
                $db->query($sql);
             }

        }

         // Si esta en un chat de usuario
        if(!empty($chats['usuario'])) {

            // Paso a offline en los chats en los que usuario normal
            foreach ($chats['usuario'] as $chat) {
                $sql = "UPDATE usuarios_chat SET isOnline = false WHERE idChat = $chat";
                $db->query($sql);
             }

        }

    }

    public static function onlineAlumno ($id, $idChat, $type, $db) {
        $id = self::getIdAlumno($id, $db);

        if($type === 'host') {
            $db->query("UPDATE chat SET isOnlineHost = true WHERE id = $idChat");
        }

        if($type === 'usuario') {
            $db->query("UPDATE usuarios_chat SET isOnline = true WHERE idChat = $idChat");
        }

    }

    public static function offlineDocente ($id, $db) {
        $id = self::getIdDocente($id, $db);
        $chats = [];

        $result = $db->query("SELECT id FROM chat WHERE idDocente = $id");

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $chats[] = $row['id'];
        }

        foreach ($chats as $chat) {
            $db->query("UPDATE chat SET isOnlineDocente = false WHERE idDocente = $id AND id = $chat");
        }

    }

    
    public static function onlineDocente($id, $idChat , $db) {
        $id = self::getIdDocente($id, $db);
        $db->query("UPDATE chat SET isOnlineDocente = true WHERE id = $idChat");
    }

}
