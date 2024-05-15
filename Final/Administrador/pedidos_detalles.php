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
            #contenedor #etiqueta, #contenedor #info{
                width: 50%;
            }
        </style>
    </head>

    <body>
        <?php include('menu.php'); ?><!-- Agrega la parte del menu en el html -->
        <br><br><br>
        <div id="contenedor">
            <h1>Detalles de pedido</h1>
            <?php
                $sql = "SELECT * FROM pedidos
                WHERE id = $id AND status = 1";
    
                $res = $con->query($sql); //ejecuta una consulta en la conexion
            
                // Verificar la consulta echa
                if ($row = $res->fetch_array()) {
                    //cantidad de productos, el costo, el subtotal y el gran total del pedido.
                    $stock = $row["stock"];
                    $costo = $row["costo"];
                    $subtotal = $row["subtotal"];
                    $total = $row["total"];
                    
                    echo "
                    
                    <div class='data'> 
                        <div id='etiqueta'>Stock: </div>
                        <div id='info'>$stock</div>
                    </div>

                    <div class='data'> 
                        <div id='etiqueta'>Costo: </div>
                        <div id='info'>$costo</div>
                    </div>
                    
                    <div class='data'> 
                        <div id='etiqueta'>Subtotal: </div>
                        <div id='info'>$$subtotal</div>
                    </div>

                    <div class='data'> 
                        <div id='etiqueta'>Total: </div>
                        <div id='info'>$$total</div>
                    </div>
                    </div>";
                } else {
                    echo "No se encontraron resultados para la ID deseado";
                }
            ?>
            <br>
            <a class="opciones" id="regresar" href="./pedidos_lista.php">Regresar al listado</a> <br><br>            
        </div>
    </body>
</html>