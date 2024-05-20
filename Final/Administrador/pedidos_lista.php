<?php 
    require "./func/session.php"; // Verifica que se inicio sesion
    require "./func/conecta.php"; //Conexion y verificacion de la base de datos
    
    $con = conecta();//conecta y verifica si se hizo bien
?>
<html>
    <head>
        <title>Listado de pedidos</title>
        <link rel="stylesheet" type="text/css" href="./css/style_list.css?v=<?php echo time(); ?>">
        <style>
            /* Se ajusta las columnas para esta tavla en particular */
            .table .header, .table div[class^='info']{ /*[class^='info'] selecciona la clase que empieza con 'info' */
                grid-template-columns: repeat(5,20%);
            }
            .header #opciones{
                grid-column: span 1;
            }
            
        </style>
        <script src='../../jQuery/jquery-3.3.1.min.js'></script>

    </head>
    <body>
        <?php 
            include('menu.php'); // Agrega la parte del menu en el html
            
            //Consulta a la base de datos de empleados activos y no eliminados
            $sql = "SELECT * FROM pedidos WHERE status = 1 "; 

            $res = $con->query($sql); //ejecuta una consulta en la conexion
            $num = $res->num_rows;

            echo "<br><h1>Listado de pedidos ($num)</h1>";
        ?>
        <br>
        <div class="table">
            <!-- Header de la tabla -->
            <div class='header' >
                <div id="id"><b>ID</b></div>
                <div id="id_cliente"><b>ID Cliente</b></div>
                <div id="status"><b>Status</b></div>
                <div id="fecha"><b>Fecha</b></div>
                <div id="opciones"><b>Opcion</b></div>
            </div>
            <?php
                /*fetch_array nos recupera una fila de resultados 
                como una matriz asociativa de la consulta*/
                while($row = $res->fetch_array()){ 
                    $id = $row['id'];
                    $id_cliente = $row['id_usuario'];
                    $status = $row['status']==1?'Cerrado':'Abierto';
                    $fecha = $row['fecha'];

                    // Datos obtenidos de la consulta
                    echo "
                        <div class='info$id'>
                            <div id='$id'>$id</div>
                            <div id='id_cliente'>$id_cliente</div>
                            <div id='status'>$status</div>
                            <div id='fecha'>$fecha</div>
                            <a id='detalles' href='./pedidos_detalles.php?id=$id'>Ver detalles</a>
                        </div>";
                        // Los href's se cambiara en un futuro, es provicional
                }
            ?>
        </div>
    </body>