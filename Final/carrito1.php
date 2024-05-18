<?php
    require "./Administrador/func/conecta.php"; //Conexion y verificacion de la base de datos
    $con = conecta();//conecta y verifica si se hizo bien
?>
<html>
    <head>
        <title>Carrito</title>
        <link href="./css/style_carrito.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
        <script src='../jQuery/jquery-3.3.1.min.js'></script>
    </head>

    <body>
        <header>
            <?php 
                include('menu.php'); // Agrega la parte del menu en el html
            ?>
        </header>
        <h2>Carrito 1/2</h2>
        <?php
            if(isset($idSession)){
                $sql = "SELECT id FROM pedidos WHERE id_usuario = $idSession AND status = 0";
                $res = $con->query($sql); //ejecuta una consulta en la conexion
        
            if ($num = $res->num_rows > 0) {
                $row = $res->fetch_array();
                $id_pedido= $row['id'];

                $sql = "SELECT * FROM pedidos_productos WHERE id_pedido = $id_pedido";
                $res = $con->query($sql); //ejecuta una consulta en la conexion
                $num = $res->num_rows;

            echo '<table id="carrito">
            <tr>
                <th scope="col">Producto</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Costo unitario</th>
                <th scope="col">Subtotal</th>
                <th scope="col">Opcion</th>
            </tr>';
            $cont = 1;
            $totalPrecioFinal = 0;
            while($pedido = $res->fetch_assoc()){//Tiene todas las filas de la consulta en forma de matriz){
                $sql = "SELECT nombre FROM productos WHERE id = ".$pedido["id_producto"];
                $res = $con->query($sql); //ejecuta una consulta en la conexion
                
                if($num = $res->num_rows > 0) {//Validacion para obtener el nombre del producto
                    $nombre_producto = $res->fetch_assoc();
                    $nombreProducto = $nombre_producto["nombre"];
                }else{
                    $nombreProducto = 'Producto'.$cont;
                }

                //Impresion de datos en la tabla carrito
                $subtotal = $pedido["precio"] * $pedido["cantidad"];
                echo '
                <tr>
                    <td><b>'.$nombreProducto.'</b></td>
                    <td>'.$pedido["cantidad"].'</td>
                    <td> $'.number_format($pedido["precio"]).'</td>
                    <td>'.$subtotal.'</td>
                    <td>
                        <a id="eliminar" href="javascript:void(0);" onclick="eliminaAjax($id);">Eliminar</a>
                    </td>
                </tr>';
                $cont++;
            }
            
            echo '</table>';
            echo '<a id="confirmar" href="#";">Confirmar carrito</a>';

            } else {
                echo "No hay productos disponibles.";
            }
        }else{
            header("Location: ./index.php");
        }
        ?>
        <footer>
            <a href="./index.php">EfraTronic.com </a>| 
            Todos los derechos reservados | 
            <a href="./politica.php">Politica de Privacidad </a>| 
            <a href="./terminos.php">Terminos y condiciones </a>
        </footer>
    </body>
</html>