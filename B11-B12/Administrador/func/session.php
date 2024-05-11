<?php
    session_start(); //inicia una nueva sesión o reanuda la existente

    if(!isset($_SESSION['nombreUser'])){ //Si esta vacio, no se inicio sesion
        header("Location: index.php");//regresa al login
    }else {
        //Variables de sesion
        $id = $_SESSION['idUser'];
        $nombre = $_SESSION['nombreUser'];
        $correo = $_SESSION['correoUser'];
    }

?>