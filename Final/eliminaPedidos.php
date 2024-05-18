<?php //Conexion y verificacion de la base de datos
    require "./Administrador/func/conecta.php";
    $con = conecta();//conecta y verifica si se hizo bien

    $id = $_REQUEST['id'];// id de pedidos_productos
    $id_pedido = $_REQUEST['id_pedido'];

    $sql = "DELETE FROM pedidos_productos WHERE id = $id"; //Elimina segun el id seleccionado
    $res = $con->query($sql); //ejecuta una consulta en la conexion
    
    if($res === true){ //Verificacion de consulta
        $sql = "SELECT cantidad, precio FROM pedidos_productos WHERE id_pedido = $id_pedido";
        $res = $con->query($sql); //ejecuta una consulta en la conexion
        $totalPedido = 0;
        while($row = $res->fetch_array()){ 
            $totalPedido= $totalPedido + ($row["cantidad"]*$row["precio"]);
        }
        echo $totalPedido; //mando el nuevo total del pedido para actualizar la pagina
    }else{
        echo -1;
    }
    //header("Location: empleados_lista.php");
?>