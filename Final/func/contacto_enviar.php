<?php
    //Variables del formulario
    $nombre = $_REQUEST["nombre"];
    $correo = $_REQUEST["correo"];

    //Complementamos el mensaje para el correo
    $comentarios = '"'.$_REQUEST["comentarios"].'"'."\r\n\n".
        'Recibimos tu mensaje, en un momento te atenderemos. gracias por su paciencia.';

    $asunto    = 'efraTronic recibio tu correo, '.$nombre;
    $de = 'From: efraTronic45@gmail.com'."\r\n".
            'Reply-To: efraTronic45@gmail.com';

    echo mail($correo, $asunto, $comentarios, $de);
    //Si la funcion regresa un 1, se envio correctamente 
?>