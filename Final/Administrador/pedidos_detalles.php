<?php 
    require "./func/session.php"; // Verifica que se inicio sesion
    require "./func/conecta.php";//Conexion y verificacion de la base de datos
    
    $con = conecta();//conecta y verifica si se hizo bien
    $id = $_REQUEST['id']; //recibe el valor de la id deseado
?>

<html>
    <head>
        <title>Detalles de pedido</title>
        <link href="./css/style_details.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
        <style>
            #contenedor{
                width: 80%;
            }
            #carrito{
                border-collapse: collapse; 
                width: 100%;
                margin: auto; 
                min-width: 550px; 
                box-shadow: 10px 5px 20px rgba(0, 0, 0, 0.15); 
                font-size: 1em;
                font-family: 'Segoe UI';
                border-radius: 0.45em;
            }
            #carrito thead tr, #carrito #total, #carrito #resTotal{ 
                background-color: #b0c0d7; 
            }
            #carrito #imagen{ 
                width: 10%;
            }
            #carrito img{ 
                width: 100%;
            }
            #carrito #descripcion{ 
                width: 25%;
                max-width: 165px;
                word-break: break-word;
                text-align: left;
            }
            #carrito th, #carrito td { 
                padding: 1% 2%; 
                text-align: center;
            }
            #carrito tbody tr { 
                border-bottom: 1px solid #b0b0b0; 
            } 
            #carrito tbody tr:nth-of-type(even) { 
                background-color: #b0b0b0 ; 
            } 
            #carrito tbody tr:last-of-type { 
                border-bottom: 1px solid #b0b0b0; 
            }
        </style>
    </head>

    <body>
        <?php include('menu.php'); ?><!-- Agrega la parte del menu en el html -->
        <br><br><br>
        <div id="contenedor">
            <h1>Detalles de pedido</h1>
            <?php
                $sql = "SELECT * FROM pedidos_productos WHERE id_pedido = $id;";
    
                $resPedidoProductos = $con->query($sql); //ejecuta una consulta en la conexion
                $totalPrecioFinal = 0;

                if($resPedidoProductos->num_rows > 0){ //Verifica las filas de la consulta
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
                    // var_dump($res->fetch_array());
                    while($pedido = $resPedidoProductos->fetch_array()){//Tiene todas las filas de la consulta en forma de matriz){
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
                            <td id="imagen"><img src="./archivos/'.$imagenProducto.'"></td>
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
                }   
                // echo '<table>   
                //         <tr>            
                //             <th>Nombre del Producto</th>
                //             <th>Cantidad</th>
                //             <th>Precio Unitario</th>
                //             <th>Precio Total</th>
                //         </tr> ';
                // // Verificar la consulta echa
                // if ($row = $res->fetch_array()) {
                //     //cantidad de productos, el costo, el subtotal y el gran total del pedido.
                //     $idproducto = $row['id_producto'];
                //     $cantidad = $row['cantidad'];
                //     $precio = $row['precio'];
                    
                //     $sql2 = "SELECT * FROM productos WHERE id = $idproducto;";
                //     $res = $con->query($sql); //ejecuta una consulta en la conexion
                //     $producto = $res->fetch_array();
                    
                //     $nombreProducto = $producto['nombre'];

                //     $precioTotal = $cantidad * $precio;

                //     $totalPrecioFinal += $precioTotal;

                //     echo '<tr>
                //             <td>' . $nombreProducto . '</td>
                //             <td>' . $cantidad . '</td>
                //             <td>' . $precio . '</td>
                //             <td>' . $precioTotal . '</td>
                //         </tr>';
                // }

                // echo '<tr>
                //         <td colspan="3" class="total">Total:</td>
                //         <td>' . $totalPrecioFinal . '</td>
                //     </tr>';
                // echo '</table>';
            ?>
            <br>
            <a class="opciones" id="regresar" href="./pedidos_lista.php">Regresar al listado</a> <br><br>            
        </div>
    </body>
</html>