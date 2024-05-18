<?php //Conexion y verificacion de la base de datos
    require "./conecta.php";
    $con = conecta();//conecta y verifica si se hizo bien
    
    //Recibe variable
    $id_producto =$_REQUEST['id_producto'];
    $id_pedido =$_REQUEST['id_pedido'];
    $cantidadPedido = $_REQUEST['cantidad'];

    $sql = "SELECT * FROM productos 
        WHERE id = '$id_producto';";

    $res = $con->query($sql); //ejecuta una consulta en la conexion
    $flag = '-2';
    if($res == TRUE){ //Verificacion de consulta SELECT
        if ($res->num_rows==0){
            $flag = '-2';  
        }else{
            $row = $res->fetch_assoc();
            $stock = $row["stock"];
            if($cantidadPedido <= 0){
                $sql = "UPDATE pedidos_productos SET cantidad = 1, 
                        WHERE id_producto = '$id_producto' AND id_pedido = '$id_pedido';";
                $res = $con->query($sql); //ejecuta una consulta en la conexion
                $flag = '-1';
            }else if($cantidadPedido > $stock){
                $sql = "UPDATE pedidos_productos SET cantidad = $stock  
                        WHERE id_producto = '$id_producto' AND id_pedido = '$id_pedido';";
                $res = $con->query($sql); //ejecuta una consulta en la conexion
                $flag = '0';
            }else{
                $sql = "UPDATE pedidos_productos SET cantidad = $cantidadPedido
                        WHERE id_producto = '$id_producto' AND id_pedido = '$id_pedido';";
                $res = $con->query($sql); //ejecuta una consulta en la conexion
                $flag = '1';
            }

            $sql = "SELECT cantidad, precio FROM pedidos_productos WHERE id_pedido = $id_pedido";
            $res = $con->query($sql); //ejecuta una consulta en la conexion
            $totalPedido = 0;
            if($res->num_rows > 0){
                while($row = $res->fetch_array()){ 
                    $totalPedido= $totalPedido + ($row["cantidad"]*$row["precio"]);
                }
                $flag = $flag.'_'.$totalPedido;
            }
            echo $flag;
        }
    }else{
        echo "Error al ejecutar la consulta: " . $con->error;
    }
    //header("Location: pedidos_productos_lista.php");
?>