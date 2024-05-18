<?php
    session_start();
    require "./Administrador/func/conecta.php";
    $con = conecta();//conecta y verifica si se hizo bien

    $idSession = $_SESSION['idClient']; //variable de session

    //Consultar id_pedido STATUS ABIERTO = 0
    $sql = "SELECT id FROM pedidos WHERE id_usuario = $idSession AND status = 0";
    $resPedido = $con->query($sql); //ejecuta una consulta en la conexion
    if($resPedido->num_rows > 0){
        $row = $resPedido->fetch_assoc();

        $sql = "SELECT id FROM pedidos_productos WHERE id_pedido = ".$row["id"];
        $res = $con->query($sql); //ejecuta una consulta en la conexion
        echo $res->num_rows;
    }else{
        echo 0;
    }

?>