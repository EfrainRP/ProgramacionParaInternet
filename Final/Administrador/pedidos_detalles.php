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
                width: 90%;
            }
        </style>
    </head>

    <body>
        <?php include('menu.php'); ?><!-- Agrega la parte del menu en el html -->
        <br><br><br>
        <div id="contenedor">
            <h1>Detalles de pedido</h1>
            <?php
                $sql = "SELECT * FROM pedidos_productos WHERE id_pedido = $id_pedido;";
    
                $res = $con->query($sql); //ejecuta una consulta en la conexion
                $totalPrecioFinal = 0;

                echo '<table>   
                        <tr>            
                            <th>Nombre del Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Precio Total</th>
                        </tr> ';
                // Verificar la consulta echa
                if ($row = $res->fetch_array()) {
                    //cantidad de productos, el costo, el subtotal y el gran total del pedido.
                    $idproducto = $row['id_producto'];
                    $cantidad = $row['cantidad'];
                    $precio = $row['precio'];
                    
                    $sql2 = "SELECT * FROM productos WHERE id = $idproducto;";
                    $res = $con->query($sql); //ejecuta una consulta en la conexion
                    $producto = $res->fetch_array();
                    
                    $nombreProducto = $producto['nombre'];

                    $precioTotal = $cantidad * $precio;

                    $totalPrecioFinal += $precioTotal;

                    echo '<tr>
                            <td>' . $nombreProducto . '</td>
                            <td>' . $cantidad . '</td>
                            <td>' . $precio . '</td>
                            <td>' . $precioTotal . '</td>
                        </tr>';
                }

                echo '<tr>
                        <td colspan="3" class="total">Total:</td>
                        <td>' . $totalPrecioFinal . '</td>
                    </tr>';
                echo '</table>';
            ?>
            <br>
            <a class="opciones" id="regresar" href="./pedidos_lista.php">Regresar al listado</a> <br><br>            
        </div>
    </body>
</html>