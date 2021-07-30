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

        if(empty($idDocente)) {
            header('Location: ../crear.php?empty=true');
        }

        $sqlExistencia = "SELECT * FROM chat WHERE asignatura = '$asignatura' AND idDocente = $idDocente";
        $resultado = $db->query($sqlExistencia);

        while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
            header('Location: ../crear.php?created=true');
            return;
        }

        return false;
    }

    public static function crearChat($datosAlumno, $datosDocente, $db) {
        $asignatura = $_POST['asignatura'];
        $idHost = Chat::getIdAlumno($datosAlumno['idAlumno'], $db);
        $nombreHost = $datosAlumno['nombreAlumno'];
        $apellidoHost = $datosAlumno['apellidoAlumno'];
    
        $idDocente = $datosDocente['idDocente'];
        $nombreDocente = $datosDocente['nombreDocente'];
        $apellidoDocente = $datosDocente['apellidoDocente'];
    
        $sql = "INSERT INTO chat (idHost, nombreHost, apellidoHost, idDocente, nombreDocente, apellidoDocente, asignatura) 
                VALUES
                 ($idHost, '$nombreHost', '$apellidoHost', $idDocente, '$nombreDocente', '$apellidoDocente', '$asignatura')";
                 
        $stmt = $db->prepare($sql);

        if($stmt->execute()) {
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

    public static function getIdAlumno($id, $db) {
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

    public static function getIdDocente($id, $db) {
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

    public static function getDatos($idChat, $db) {
        $sql = "SELECT * FROM chat WHERE id = $idChat";
        $result = $db->query($sql);

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $idHost = $row['idHost'];
            $nombreHost = $row['nombreHost'];
            $apellidoHost = $row['apellidoHost'];
            $idDocente = $row['idDocente'];
            $nombreDocente = $row['nombreDocente'];
            $apellidoDocente = $row['apellidoDocente'];
            $asignatura = $row['asignatura'];
        }

        return [
            "idHost" => $idHost,
            "nombreHost" => $nombreHost,
            "apellidoHost" => $apellidoHost,
            "idDocente" => $idDocente,
            "nombreDocente" => $nombreDocente,
            "apellidoDocente" => $apellidoDocente,
            "asignatura" => $asignatura
        ];
    }
}
