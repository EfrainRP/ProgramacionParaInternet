<?php
    session_start(); //inicia una nueva sesión o reanuda la existente

    session_destroy(); //destruye la sesion de la pagina
    if(isset($_SERVER['HTTP_REFERER'])) {//Obtenemos la url anterior para regresar despues con el boton REGRESAR 
        $url_anteriorCompleto = $_SERVER['HTTP_REFERER'];
        
        header("Location: $url_anteriorCompleto"); //donde se encuentra este arhivo, se redireccionara al index de clientes
    }
?>