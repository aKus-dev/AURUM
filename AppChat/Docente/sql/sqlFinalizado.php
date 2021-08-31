<?php

require "../../../config/app.php";
$idChat = $_GET['idChat'];


$sql = "SELECT * FROM chat WHERE id = $idChat";
$resultado = $db->query($sql);

while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
    echo $idChat;
}