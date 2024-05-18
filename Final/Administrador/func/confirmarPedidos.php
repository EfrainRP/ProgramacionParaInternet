<?php //Conexion y verificacion de la base de datos
    require "./conecta.php";
    $con = conecta();//conecta y verifica si se hizo bien
    
    //Recibe variable
    $id_pedido =$_REQUEST['id_pedido'];

    $sql = "UPDATE pedidos SET status = 1 WHERE id = '$id_pedido';";
    $resMain = $con->query($sql); //ejecuta una consulta en la conexion

    if($resMain === true){ //Verificacion de consulta
        $sql = "SELECT id_producto, cantidad FROM pedidos_productos WHERE id_pedido = $id_pedido";
        $res = $con->query($sql); //ejecuta una consulta en la conexion

        while($row = $res->fetch_array()){ 
            $idProducto = $row['id_producto'];
            $cantidad = $row['cantidad'];
            $sql = "UPDATE productos SET stock = stock-$cantidad WHERE id = $idProducto;";
            $resUpdate = $con->query($sql); //ejecuta una consulta en la conexion
        }
        
        echo $resMain; //manda el valor como bandera del resultado de la consulta
    }else{
        echo "Error al ejecutar la consulta: " . $con->error;
    }
    //header("Location: pedidos_productos_lista.php");
?>