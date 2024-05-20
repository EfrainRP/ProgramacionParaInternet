<?php
    require "./Administrador/func/conecta.php"; //Conexion y verificacion de la base de datos
    $con = conecta();//conecta y verifica si se hizo bien
?>
<html>
    <head>
        <title>Carrito</title>
        <link href="./css/style_carrito.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
        <script src='../jQuery/jquery-3.3.1.min.js'></script>
        <script src='./js/numCarrito.js'></script>
        <script>
            function eliminaAjax(id,idPedido){
                $.ajax({ //Metodo de js para ejecutar archivos de manera asincrona
                    url: './func/elimina_pedidos.php',
                    type:'post', 
                    dataType:'text',
                    data:'id='+id+'&id_pedido='+idPedido,
                    success:function(res){
                        console.log(res);
                        if(res != -1){//Se elimina cuando el valor res del evento es 1
                            $('#fila'+id).hide(); //Esconde los elementos con id seleccionado
                            $('#resTotal').html('$'+new Intl.NumberFormat('es-MX').format(res)); //Actualiza el precio total
                            actualizarCarrito();
                            validarTotal();
                        }else{
                            console.log('Error al eliminar');
                        }
                    },error:function(){
                        alert('Error archivo no encontrado...');
                    }
                });
            }
            function validarCantidad(idPedido,idProducto,stock,costo){
                var cant = $('.cantidadProducto'+idProducto).val();
                $.ajax({ //Metodo de js para ejecutar archivos de manera asincrona
                    url: './func/valida_pedido.php',
                    type:'post', 
                    dataType:'text',
                    data:'id_producto='+idProducto+'&id_pedido='+idPedido+'&cantidad='+cant,
                    success:function(res){
                        console.log(res);
                        var arreglo = res.split("_");
                        var total = arreglo.at(-1);
                        var subtotal = 0;
                        if(arreglo[0] == -1){//El valor es < 0
                            $('.cantidadProducto'+idProducto).val(1);
                            $("#mensaje").show();
                            $('#mensaje').html('Cantidad/es no valido/s');
                            setTimeout('$("#mensaje").html(""); $("#mensaje").hide();', 5000);
                            subtotal = costo;
                            $('#subtotal'+idProducto).html('$'+new Intl.NumberFormat('es-MX').format(subtotal));
                        }else if(arreglo[0] == 0){ //El valor es > al stock
                            $('.cantidadProducto'+idProducto).val(stock);
                            $("#mensaje").show();
                            $('#mensaje').html('Cantidad/es no valido/s');
                            setTimeout('$("#mensaje").html(""); $("#mensaje").hide();', 5000);
                            
                            subtotal = costo*stock;
                            $('#subtotal'+idProducto).html('$'+new Intl.NumberFormat('es-MX').format(subtotal));
                        }else if(arreglo[0] == 1){
                            subtotal = costo*cant;
                        }
                        $('#subtotal'+idProducto).html('$'+new Intl.NumberFormat('es-MX').format(subtotal));
                        $('#resTotal').html('$'+new Intl.NumberFormat('es-MX').format(total));
                    },error:function(){
                        alert('Error archivo no encontrado...');
                    }
                });
            }
            function validarTotal(){
                if($('#resTotal').html() == '$0'){ //Si se vacio el carrito, total tiene que ser diferente a $0
                    // window.location.href="./carrito1.php";
                    $('#continuar').html("Carrito vacio");
                    $('#continuar').attr("href","#");
                }
            }
        </script>
    </head>
    <body>
        <header>
            <?php 
                include('menu.php'); // Agrega la parte del menu en el html
            ?>
        </header>
        <h1>Carrito 1/2</h1>
        <?php
        if(isset($_SESSION['nombreClient'])){
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
                    $stockProducto = $producto["stock"];
                }

                //Impresion de datos en la tabla carrito
                $subtotal = $pedido["precio"] * $pedido["cantidad"];
                $totalPrecioFinal = $totalPrecioFinal+$subtotal;
                echo '
                <tr id="fila'.$pedido["id"].'">
                    <td id="imagen"><img src="./Administrador/archivos/'.$imagenProducto.'"></td>
                    <td><b>'.$nombreProducto.'</b></td>
                    <td id="descripcion">'.$descripProducto.'</td>
                    <td>
                        <input type="number" class="cantidadProducto'.$pedido["id_producto"].'"
                            onchange="validarCantidad('.$pedido["id_pedido"].','.$pedido["id_producto"].','.$stockProducto.','.$pedido["precio"].')" 
                            min="1" max="'.$stockProducto.'" step="1" value="'.$pedido["cantidad"].'">

                        <script>validarCantidad('.$pedido["id_pedido"].','.$pedido["id_producto"].','.$stockProducto.','.$pedido["precio"].');</script>
                    </td>
                    <td id="costo">$'.number_format($pedido["precio"]).'</td>
                    <td id="subtotal'.$pedido["id_producto"].'">$'.number_format($subtotal).'</td>
                    <td>
                        <a id="eliminar" href="javascript:void(0);" onclick="eliminaAjax('.$pedido["id"].','.$pedido["id_pedido"].');">Eliminar</a>
                    </td>
                </tr>';
            }
            echo '
                <tr>
                    <td></td><td></td><td></td><td></td><td id="total"><b>Total</b></td><td id="resTotal">$'.number_format($totalPrecioFinal).'</td>
                </tr>
            </table>';
            echo '  <div id="divMensaje"><div id="mensaje"></div></div>
                    <script>$("#mensaje").hide();</script>
                    <div id="btnContinuar">
                        <a id="continuar"  href="./carrito2.php" onclick="validarTotal();">Continuar carrito</a>
                    </div>';

            } else {
                echo "<h2>No hay productos en carrito.</h2>";
            }
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