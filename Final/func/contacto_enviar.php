<?php

    //Variables del formulario
    $nombre = $_REQUEST["nombre"];
    // $correo = $_REQUEST["correo"];
    $comentarios = $_REQUEST["comentarios"];
    
    $para      = 'aquí va el correo de a quien envías';
    $asunto    = 'Contacto';
    $de = 'From: efraTronic45@gmail.com'."\r\n".'Reply-To: efrain.robles5009@alumnos.udg.mx';
    $correo = 'efraTronic45@gmail.com';
    if (mail($correo, $asunto, $comentarios, $de))
    {
        echo "success";
    }
?>