<?php

class Chat
{

    public static function datosDocente($asignatura, $grupo, $db)
    {
        $idDocente = '';
        $nombreDocente = '';
        $apellidoDocente = '';
        $idRealDocente = '';

        // Obtengo los datos del profesor de esa asignatura en el grupo
        $sql  = "SELECT DISTINCT CI, nombre, apellido, email
         FROM docente
         INNER JOIN grupos_docente
         ON grupos_docente.idDocente = docente.id AND grupo = '$grupo'
         INNER JOIN asignaturas_docente as asignaturas
         ON docente.id = asignaturas.idDocente AND asignatura = '$asignatura'";

        $result = $db->query($sql);
        // Recorro los datos del docente
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $ciDocente = $row['CI'];
            $nombreDocente = $row['nombre'];
            $apellidoDocente = $row['apellido'];
            $emailDocente = $row['email'];
        }

        $datosDocente = [
            "ciDocente" => $ciDocente,
            "nombreDocente" => $nombreDocente,
            "apellidoDocente" => $apellidoDocente,
            "emailDocente" => $emailDocente,
            "idRealDocente" => $idRealDocente
        ];


        return $datosDocente;
    }

    public static function revisarExistencia($ciDocente, $asignatura, $grupo, $datosAlumno, $db)
    {
        $mismoGrupo = false;
        $entro = false;


        if (empty($ciDocente)) {
            header('Location: ../crear.php?empty=true');
        }

        $sqlExistencia = "SELECT * FROM chat WHERE asignatura = '$asignatura' AND ciDocente = '$ciDocente'";
        $resultado = $db->query($sqlExistencia);


        while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
            $entro = true;
            // Si el chat creado es del mismo grupo aviso
            if ($row['grupo'] == $grupo) {
                $mismoGrupo = true;
            }
        }

        // Si es del mismo grupo lo re direciono y le digo que ya esta creado
        if ($mismoGrupo) {
            header('Location: ../crear.php?created=true');
            return true;
        }

        // Si no es del mismo grupo y el chat existe mando una solicitud al docente
        if (!$mismoGrupo && $entro) {
            // El chat esta creado pero NO es de este grupo
            self::enviarSolicitud($datosAlumno, $ciDocente, $asignatura, $grupo, $db);
            return true;
        }



        return false;
    }
    public static function enviarSolicitud($datosAlumno, $ciDocente, $asignatura, $grupo, $db)
    {
        $ciHost = $datosAlumno['ciHost'];
        $nombreHost = $datosAlumno['nombreAlumno'];
        $apellidoHost = $datosAlumno['apellidoAlumno'];
        $emailHost = $datosAlumno['emailAlumno'];

        $enviado = false;

        $sql = "SELECT ciDocente, asignatura, grupo FROM solicitud_chat";
        $resultado = $db->query($sql);

        while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
            // Si ya se le envio solicitud a ese profesor-materia-grupo
            if ($ciDocente == $row['ciDocente'] && $asignatura == $row['asignatura'] && $grupo == $row['grupo']) {
                $enviado = true;
            }
        }

        if (!$enviado) {
            $sql = "
            INSERT INTO solicitud_chat (ciDocente, ciHost, nombreHost, apellidoHost, emailHost, asignatura, grupo) 
            VALUES ('$ciDocente', '$ciHost', '$nombreHost', '$apellidoHost', '$emailHost', '$asignatura','$grupo');
        ";

            $db->query($sql);
        }

        header('Location: ../crear.php?solicitud=true');
    }

    public static function crearChat($datosAlumno, $datosDocente, $grupo, $db)
    {
        date_default_timezone_set("America/Montevideo");
        $fecha = date('Y-m-d'); // Antes estaba en Y-m-d

        $asignatura = $_POST['asignatura'];
        $ciHost = $_POST['ciHost'];
        $nombreHost = $datosAlumno['nombreAlumno'];
        $apellidoHost = $datosAlumno['apellidoAlumno'];
        $emailHost = $datosAlumno['emailAlumno'];

        $ciDocente = $datosDocente['ciDocente'];
        $nombreDocente = $datosDocente['nombreDocente'];
        $apellidoDocente = $datosDocente['apellidoDocente'];
        $emailDocente = $datosDocente['emailDocente'];

        $sql = "INSERT INTO chat (ciHost, nombreHost, apellidoHost,emailHost, ciDocente, nombreDocente, apellidoDocente, emailDocente, fecha, asignatura, grupo) 
                VALUES
                 ('$ciHost', '$nombreHost', '$apellidoHost', '$emailHost', '$ciDocente', '$nombreDocente', '$apellidoDocente', '$emailDocente', '$fecha', '$asignatura', '$grupo')";

        $stmt = $db->prepare($sql);

        if ($stmt->execute()) {
            return $datosChat = [
                "asignatura" => $asignatura,
                "idHost" => $ciHost,
                "nombreHost" => $nombreHost,
                "apellidoHost" => $apellidoHost,
                "emailHost" => $emailHost,
                "idDocente" => $ciDocente,
                "nombreDocente" => $nombreDocente,
                "apellidoDocente" => $apellidoDocente,
                "emailDocente" => $emailDocente

            ];
        }
    }



    public static function getDatos($idChat, $db)
    {
        $sql = "SELECT * FROM chat WHERE id = $idChat";
        $result = $db->query($sql);

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $idChat = $row['id'];
            $ciHost = $row['ciHost'];
            $nombreHost = $row['nombreHost'];
            $apellidoHost = $row['apellidoHost'];
            $ciDocente = $row['ciDocente'];
            $nombreDocente = $row['nombreDocente'];
            $apellidoDocente = $row['apellidoDocente'];
            $asignatura = $row['asignatura'];
            $grupo = $row['grupo'];
        }

        return [
            "idChat" => $idChat,
            "ciHost" => $ciHost,
            "nombreHost" => $nombreHost,
            "apellidoHost" => $apellidoHost,
            "ciDocente" => $ciDocente,
            "nombreDocente" => $nombreDocente,
            "apellidoDocente" => $apellidoDocente,
            "asignatura" => $asignatura,
            "grupo" => $grupo
        ];
    }

    public static function enviarMensaje($idChat, $ciUsuario, $nombre, $apellido,  $mensaje, $db)
    {
        date_default_timezone_set("America/Montevideo");
        $hora = Date('G:i');

        if (!empty($mensaje)) {
            $mensaje = $db->quote($mensaje); // Evito que caracteres como comillas den error en el query
            $sql = "INSERT INTO mensajes_chat (idChat, ciUsuario, nombreUsuario, apellidoUsuario, mensaje, hora) 
            VALUES ($idChat, '$ciUsuario', '$nombre', '$apellido', $mensaje, '$hora')";

            $stmt = $db->prepare($sql);
            $stmt->execute();
        }
    }

    public static function offlineAlumno($ci, $db)
    {
        $chats = [];

        $result = $db->query("SELECT id FROM chat WHERE ciHost = '$ci'");

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $chats['host'][] = $row['id'];
        }

        $sql = "SELECT idChat  FROM usuarios_chat WHERE ciUsuario = $ci";
        $result = $db->query($sql);

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $chats['usuario'][] = $row['idChat'];
        }

        // Si esta en un chat de host
        if (!empty($chats['host'])) {

            // Paso a offline en los chats en los que es host
            foreach ($chats['host'] as $chat) {
                $sql = "UPDATE chat SET isOnlineHost = false WHERE id = $chat";
                $db->query($sql);
            }
        }

        // Si esta en un chat de usuario
        if (!empty($chats['usuario'])) {

            // Paso a offline en los chats en los que usuario normal
            foreach ($chats['usuario'] as $chat) {
                $sql = "UPDATE usuarios_chat SET isOnline = false WHERE idChat = $chat";
                $db->query($sql);
            }
        }
    }

    public static function onlineAlumno($ci, $idChat, $type, $db)
    {
        if ($type === 'host') {
            $db->query("UPDATE chat SET isOnlineHost = true WHERE id = $idChat");
        }

        if ($type === 'usuario') {
            $db->query("UPDATE usuarios_chat SET isOnline = true WHERE idChat = $idChat AND ciUsuario = '$ci'");
        }
    }

    public static function offlineDocente($ci, $db)
    {
        $chats = [];

        $result = $db->query("SELECT id FROM chat WHERE ciDocente = $ci");

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $chats[] = $row['id'];
        }

        foreach ($chats as $chat) {
            $db->query("UPDATE chat SET isOnlineDocente = false WHERE ciDocente = $ci AND id = $chat");
        }
    }


    public static function onlineDocente($idChat, $db)
    {
        $db->query("UPDATE chat SET isOnlineDocente = true WHERE id = $idChat");
    }

    public static function getHorarioDocente($ciDocente, $db)
    {
        $diaMinimo = '';
        $diaMaximo = '';
        $horaMinima = '';
        $horaMaxima = '';

        // Obtengo los datos del horario del profe
        $sqlHorarios = "SELECT dia_minimo, dia_maximo, hora_minima, hora_maxima FROM docente WHERE ci = $ciDocente";
        $resultadoHorarios = $db->query($sqlHorarios);

        // Iterar resultados;
        while ($datos = $resultadoHorarios->fetch(PDO::FETCH_ASSOC)) {
            $diaMinimo = $datos['dia_minimo'];
            $diaMaximo = $datos['dia_maximo'];
            $horaMinima = $datos['hora_minima'];
            $horaMaxima = $datos['hora_maxima'];
        }

        if (empty($diaMinimo) && empty($diaMaximo) && empty($horaMinima) && empty($horaMaxima)) {
            header('Location: /AppChat/Alumno/hostchats.php?sinHorarios=true');
            return;
        }

        date_default_timezone_set("America/Montevideo");

        $diaActual = date('N'); // Días (1: lunes 7: domingo)
        $horaActual = date('G'); // Horas (0 - 23)

        if ($diaActual >= $diaMinimo && $diaActual <= $diaMaximo && $horaActual >= $horaMinima && $horaActual <= $horaMaxima) {
            return false;
        }

        return true;
    }


    public static function getEmails($idChat, $db)
    {
        $emails = [];

        $sql = "SELECT email FROM usuarios_chat WHERE idChat = $idChat";
        $resultados = $db->query($sql);

        // Iterar resultados;
        while ($datos = $resultados->fetch(PDO::FETCH_ASSOC)) {
            $emails[] = $datos['email'];
        }

        $sql = "SELECT emailHost, emailDocente FROM chat WHERE id = $idChat LIMIT 1";
        $resultados = $db->query($sql);

        // Iterar resultados;
        while ($datos = $resultados->fetch(PDO::FETCH_ASSOC)) {
            $emails[] = $datos['emailHost'];
            $emails[] = $datos['emailDocente'];
        }

        return $emails;
    }


    public static function getMensajes($idChat, $db)
    {
        $mensajes = '';
        $header = '';

        $sql = "SELECT nombreHost, apellidoHost, asignatura FROM chat WHERE id = $idChat";
        $result = $db->query($sql);

        // Iterar resultados;
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $nombreHost = $row['nombreHost'];
            $apellidoHost = $row['apellidoHost'];
            $asignatura = $row['asignatura'];

            $header = "
                <header style='
                border-radius: 5px;
                background: linear-gradient(90deg, #B1126F, #531A5D);
                color: #FFF;
                font-size: 20px;
                text-align: center;
                padding: 15px;
                margin-bottom: 25px;
                font-family: Arial;
                '>
                    <b>Creado por:</b> <span style='color: #ececec; margin-right: 50px'>$nombreHost $apellidoHost</span> <b>Asignatura:</b> <span style='color: #ececec'>$asignatura</span>
                </header>
            ";

        }


        $sql = "SELECT nombreUsuario, apellidoUsuario, mensaje, hora FROM mensajes_chat WHERE idChat = $idChat";
        $resultados = $db->query($sql);


        // Iterar resultados;
        while ($datos = $resultados->fetch(PDO::FETCH_ASSOC)) {
            $nombre = $datos['nombreUsuario'];
            $apellido = $datos['apellidoUsuario'];
            $mensaje = $datos['mensaje'];
            $hora = $datos['hora'];

            $mensajes .= "

            <p style='
            display: inline-block;
            max-width: 350px;
            margin: 5px 0;
            background: linear-gradient(90deg, #B1126F, #531A5D);
            color:#FFF; 
            font-family: Arial;
            padding: 10px 20px;
            border-radius: 10px 10px 10px 0;
            '>
            $mensaje
            </p>

            <p style='
                margin: 5px 0;
            '>
            <span style='color: #2b2c2e; font-weight: bold;'>$nombre $apellido</span> $hora
            </p> 
    
            
            <br>

            ";
        }

        $mensajes = $header . $mensajes;
        
        return $mensajes;
    }

    public static function eliminarChat($idChat, $db)
    {
        $db->query("DELETE FROM chat WHERE id = $idChat");
    }

}
