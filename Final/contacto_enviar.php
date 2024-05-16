<?php
    //Importacion de librerias de PHPMail
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    //Variables del formulario
    $nombre = $_REQUEST["nombre"];
    $correo = $_REQUEST["correo"];
    $comentarios = $_REQUEST["comentarios"];
    
    //Librerias de PHPMail
    require './Library/PHPMailer/src/Exception.php';
    require './Library/PHPMailer/src/PHPMailer.php';
    require './Library/PHPMailer/src/SMTP.php';

    $mail = new PHPMailer();//creamos el objeto Mail
    
    try {
        // Configuracion de SMTP para gmail
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'efraTronic45@gmail.com'; 
        $mail->Password   = 'efr@Tronic123'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Composicion de email
        $mail->setFrom('efraTronic45@gmail.com', 'EfraTronic');
        $mail->addAddress($correo);
        $mail->Subject = 'Seguimiento a su solicitud';
        $mail->Body    = 'Hola '. $nombre . PHP_EOL .'Este correo es para que explique mas a detalle su mensaje enviado: '. PHP_EOL . PHP_EOL . $comentarios
        . PHP_EOL . PHP_EOL .
        'Por cual darle seguimiento a este correo para atenderlo de la manera mas adecuada.';

        $mail->send();//funcion para mandar el correo
        echo 'success';
    } catch (Exception $e) {
        echo "Error al enviar el correo: {$mail->ErrorInfo}";
    }
?>