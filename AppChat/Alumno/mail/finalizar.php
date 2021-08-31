<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

require '../../../clases/Chat.php';
require '../../../config/app.php';

$idChat = $_POST['idChat'];
$emails = Chat::getEmails($idChat, $db);
$mensajes = Chat::getMensajes($idChat, $db);
$seEnvio = 0;

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 2;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'aurumproyectofinal@gmail.com';                     //SMTP username
    $mail->Password   = 'aurum12345';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('aurumproyectofinal@gmail.com', 'AURUM');

    for($i = 0; $i < count($emails); $i++) {
        $mail->AddAddress($emails[$i]); 
    }

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Mensajes del chat';
    $mail->Body    = $mensajes;

    $seEnvio = $mail->send();

    if($seEnvio) {
        Chat::eliminarChat($idChat, $db);
    }

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>

<script>
    let enviado = <?php echo $seEnvio ?>;
    
    if(enviado) {
        location.assign('../index.php?finish=true');
    }

</script>