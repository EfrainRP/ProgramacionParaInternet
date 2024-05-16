<?php
    session_start(); //inicia una nueva sesión o reanuda la existente

    session_destroy(); //destruye la sesion de la pagina
    if(isset($_SERVER['HTTP_REFERER'])) {//Obtenemos la url anterior para regresar despues con el boton REGRESAR 
        $url_anteriorCompleto = $_SERVER['HTTP_REFERER'];
        $arreglo = explode("/", $url_anteriorCompleto);
        $len = count($arreglo);
        $url_anterior = $arreglo[$len-2];//Sera index.php o productos.php
    }

    if($url_anterior == 'Administrador'){
        header("Location: ./../index.php"); //donde se encuentra este arhivo, se redireccionara al index de empleados
    }else{
        header("Location: ./../../index.php"); //donde se encuentra este arhivo, se redireccionara al index de clientes

    }
?>