<?php
    $calificacion = $_REQUEST['calificacion'];
    $ban =0;

    if($calificacion >= 60){
        $ban =1;
    }
    echo $ban;
?>