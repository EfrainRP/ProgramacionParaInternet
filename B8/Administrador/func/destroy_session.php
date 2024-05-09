<?php
    session_start(); //inicia una nueva sesión o reanuda la existente

    session_destroy();
    header("Location: ./../index.php"); //donde se encuentra este arhivo, se redireccionara al index
?>