<?php

if(empty($_POST)) {
    header('Location: ../');
}

require '../../../clases/Chat.php';
require '../../../config/app.php';

$ciHost = $_POST['ciHost'];
$nombreHost = $_POST['nombreHost'];
$apellidoHost = $_POST['apellidoHost'];
$emailHost = $_POST['emailHost'];

$asignatura = $_POST['asignatura'];
$grupo = $_POST['grupo'];
$idSolicitud = $_POST['idSolicitud'];
$ciDocente = $_POST['ciDocente'];

$nombreDocente = $_POST['nombreDocente'];
$apellidoDocente = $_POST['apellidoDocente'];
$emailDocente = $_POST['emailDocente'];


date_default_timezone_set("America/Montevideo");
$fecha = date('Y-m-d'); // Antes estaba en Y-m-d

// Lo agrego al chat
$sql = "INSERT INTO chat (ciHost, emailHost, ciDocente ,emailDocente, fecha, asignatura, grupo)
        VALUES ('$ciHost', '$emailHost', '$ciDocente', '$emailDocente', '$fecha', '$asignatura', '$grupo');
";

$db->query($sql);

  // Obtengo el id del ultimo chat
  $idChat = '';
  $sql = "SELECT id FROM chat ORDER BY id DESC LIMIT 1";
  $resultado = $db->query($sql);

  while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
      $idChat  = $row['id'];
  }

  // Inserto en la tabla de usuarios online
  $db->query("INSERT INTO usuarios_online VALUES ($idChat, '$ciHost', false), ($idChat, '$ciDocente', false)");

$db->query($sql);

// Elimino la solicitud
$db->query("DELETE FROM solicitud_chat WHERE id = $idSolicitud");


header('Location: ../solicitudes.php?success=true');
