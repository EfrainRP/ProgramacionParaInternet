<?php
    session_start(); //inicia una nueva sesión o reanuda la existente

    session_destroy(); //destruye la sesion de la pagina
    header("Location: ./../index.php"); //donde se encuentra este arhivo, se redireccionara al index
?>