<?php
    //agregarProducto.php
    session_start();

    require "./Administrador/func/conecta.php";
    $con = conecta();//conecta y verifica si se hizo bien

    $idSession = $_SESSION['idClient']; //variable de session
    //Recibe variables
    $id_producto  = $_REQUEST['id_producto'];
    $cant = $_REQUEST['cant'];

    //Consultar id_pedido STATUS ABIERTO = 0
    $sql = "SELECT * FROM pedidos WHERE id_usuario = $idSession AND status = 0";

    $res = $con->query($sql); //ejecuta una consulta en la conexion
    // $num = $res->num_rows;
    if ($res->num_rows == 0) {//Si no encontro una consulta, creara uno
        $sql   = "INSERT INTO pedidos (fecha, id_usuario) VALUES (NOW(), $idSession)";
        $res = $con->query($sql);
        $id_pedido = $con->insert_id;
    }else {//Sino, obtenemos el id del pedido
        $row = $res->fetch_assoc();
        $id_pedido = $row['id'];
    }

    //Obtenemos los datos del producto del pedido
    $sql = "SELECT costo,stock FROM productos WHERE id = $id_producto";
    $res = $con->query($sql);
    // $num = $res->num_rows;
    if ($res->num_rows > 0) {//Si encuentra al menos una fila
        $row = $res->fetch_assoc();
        $precio = $row['costo'];
        $stock = $row['stock'];
    }

    if ($cant <= $stock && $cant > 0) { //Verifica la cantidad con el stock
        // Si ya se esta pidiendo ese productos
        $sql = "SELECT * FROM pedidos_productos
                WHERE id_producto = $id_producto AND id_pedido = $id_pedido";
        $res = $con->query($sql);
        // $num = $res->num_rows;
        if ($res->num_rows == 0) {//Si no encuentra el pedido, inseta en la consulta
            $sql = "INSERT INTO pedidos_productos (id_pedido, id_producto, cantidad, precio)
                    VALUES ($id_pedido, $id_producto, $cant, $precio);";
        } else { //si lo encuentra, actualiza
            $sql = "UPDATE pedidos_productos SET cantidad = cantidad + $cant
                    WHERE id_pedido = $id_pedido AND id_producto = $id_producto";
        }
        $con->query($sql);
        echo 1;	
    } else {
        echo 0;	
    }

?>