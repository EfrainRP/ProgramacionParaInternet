<?php
    require "./Administrador/func/conecta.php"; //Conexion y verificacion de la base de datos
    $con = conecta();//conecta y verifica si se hizo bien
?>
<html>
    <head>
        <title>Carrito 2/2</title>
        <link href="./css/style_carrito.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
        <style>
            #btnContinuar{
                display: flex;
                justify-content: space-between;
            }
            #mensaje{
                width: 30%;
                color:var(--bluePalette-color);
                border: 3px dashed var(--bluePalette-color);
                text-align: center;
            }
        </style>
        <script src='../jQuery/jquery-3.3.1.min.js'></script>
        <script src='./js/numCarrito.js'></script>
    </head>

    <body>
        <header>
            <?php 
                include('menu.php'); // Agrega la parte del menu en el html
            ?>
        </header>
        <h1>Carrito 2/2</h1>
        <?php
            if(isset($idSession)){
                $sql = "SELECT id FROM pedidos WHERE id_usuario = $idSession AND status = 0";
                $res = $con->query($sql); //ejecuta una consulta en la conexion
        
            if ($num = $res->num_rows > 0) {
                $row = $res->fetch_array();
                $id_pedido= $row['id'];

                $sql = "SELECT * FROM pedidos_productos WHERE id_pedido = $id_pedido";
                $resPedidoProducto = $con->query($sql); //ejecuta una consulta en la conexion
                $num = $resPedidoProducto->num_rows;

            echo '<table id="carrito">
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Producto</th>
                    <th>Descripcion</th>
                    <th>Cantidad</th>
                    <th>Costo unitario</th>
                    <th>Subtotal</th>
                </tr>
            </thead>';
            $totalPrecioFinal = 0;
            while($pedido = $resPedidoProducto->fetch_assoc()){//Tiene todas las filas de la consulta en forma de matriz){
                $sql = "SELECT * FROM productos WHERE id = ".$pedido["id_producto"];
                $res = $con->query($sql); //ejecuta una consulta en la conexion
                
                if($num = $res->num_rows > 0) {//Validacion para obtener el nombre del producto
                    $producto = $res->fetch_assoc();
                    $nombreProducto = $producto["nombre"];
                    $imagenProducto = $producto["archivo"];
                    $descripProducto = $producto["descripcion"];
                }
                //Impresion de datos en la tabla carrito
                $subtotal = $pedido["precio"] * $pedido["cantidad"];
                echo '
                <tr id="fila'.$pedido["id"].'">
                    <td id="imagen"><img src="./Administrador/archivos/'.$imagenProducto.'"></td>
                    <td><b>'.$nombreProducto.'</b></td>
                    <td id="descripcion">'.$descripProducto.'</td>
                    <td>'.$pedido["cantidad"].'</td>
                    <td>$'.number_format($pedido["precio"]).'</td>
                    <td>$'.number_format($subtotal).'</td>
                </tr>';
                $totalPrecioFinal = $totalPrecioFinal+$subtotal;
            }
            
            echo '
                <tr>
                    <td></td><td></td><td></td><td></td><td id="total"><b>Total</b></td><td id="resTotal">$'.number_format($totalPrecioFinal).'</td>
                </tr>
            </table>';
            echo '<div id="btnContinuar">
                <a id="regresar"  href="./carrito1.php" >Regresar</a>  
                <div id="carga"><img src="./Administrador/archivos/loader.gif"></div>
                <div id="mensaje"></div>
                <script>$("#mensaje").hide();$("#carga").hide();</script>
                <a id="continuar" onclick="cerrarPedido('.$id_pedido.')";">Finalizar</a>
                </div>';
            } else {
                echo "<h2>No hay productos en carrito.</h2>";
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
        <script>
            function cerrarPedido(id){
                $.ajax({ //Metodo de js para ejecutar archivos de manera asincrona
                    url: './Administrador/func/confirmarPedidos.php', //
                    type:'post', 
                    dataType:'text',
                    data:'id_pedido='+id,
                    success:function(res){
                        console.log(res);
                        if(res == 1){
                            $('#mensaje').show(); //Esconde los elementos con id seleccionado
                            $('#mensaje').html('Gracias por su compra');
                            $('#carga').html('<img src="./Administrador/archivos/loader.gif">');
                            $('#carga').show(); //Esconde los elementos con id seleccionado
                            
                            setTimeout('$("#mensaje").html(""); $("#mensaje").hide();$("#carga").hide(); location.href = "./carrito1.php";', 3000);
                            actualizarCarrito();
                        }else{
                            console.log('Error al comprar');
                        }
                    },error:function(){
                        alert('Error archivo no encontrado...');
                    }
                });
                
            }
        </script>
    </body>
</html>