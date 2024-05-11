<?php 
    require "./func/session.php"; // Verifica que se inicio sesion
    require "./func/conecta.php"; //Conexion y verificacion de la base de datos
    
    $con = conecta();//conecta y verifica si se hizo bien
?>
<html>
    <head>
        <title>Listado de productos</title>
        <link rel="stylesheet" type="text/css" href="./css/style_list.css?v=<?php echo time(); ?>">
        <style>
            /* Se ajusta las columnas para esta tavla en particular */
            .table .header, .table div[class^='info']{ /*[class^='info'] selecciona la clase que empieza con 'info' */
                grid-template-columns: repeat(9,11.11%);
            }
            /* div[class^='info'] #descripcion{
                height:auto;
                overflow-wrap: break-word;
                /*word-break: break-all; /* Se rompe la palabra para ajustarlo al div
                text-align: center;
            } */
        </style>
        <script src='../../jQuery/jquery-3.3.1.min.js'></script>
        <script>
            function eliminaAjax(id){
                if(confirm("¿Seguro de que quieres eliminar este producto?")){//Segun lo que salga en la ventana de confirmacion, ejecutara el archivo
                    $.ajax({ //Metodo de js para ejecutar archivos de manera asincrona
                        url: './productos_elimina.php', //
                        type:'post', 
                        dataType:'text',
                        data:'id='+id,
                        success:function(res){
                            console.log(res);
                            if(res == 1){//Se elimina cuando el valor res del evento es 1
                                $('.info'+id).hide(); //Esconde los elementos con id seleccionado
                            }else{
                                console.log('Error al eliminar');
                            }
                        },error:function(){
                            alert('Error archivo no encontrado...');
                        }
                    });
                }
            }
        </script>

    </head>
    <body>
        <?php 
            include('menu.php'); // Agrega la parte del menu en el html
            $sql = "SELECT * FROM productos
                    WHERE status = 1 AND eliminado = 0"; //Consulta a la base de datos de empleados activos y no eliminados

            $res = $con->query($sql); //ejecuta una consulta en la conexion
            $num = $res->num_rows;

            echo "<br><h1>Listado de productos ($num)</h1>";
        ?>
        <a class='opciones' id="crearRegistro" href="./productos_alta.php"><b>Dar de alta</b></a><br><br>
        <br>
        <div class="table">
            <!-- Header de la tabla -->
            <div class='header' >
                <div id="id"><b>ID</b></div>
                <div id="nombre"><b>Nombre</b></div>
                <div id="codigo"><b>Codigo</b></div>
                <div id="descripcion"><b>Descripcion</b></div>
                <div id="costo"><b>Costo</b></div>
                <div id="stock"><b>Stock</b></div>
                <div id="opciones"><b>Opciones</b></div>
            </div>
            <?php
                /*fetch_array nos recupera una fila de resultados 
                como una matriz asociativa de la consulta*/
                while($row = $res->fetch_array()){ 
                    $id = $row["id"];
                    $nombre = $row["nombre"];
                    $codigo = $row["codigo"];
                    $descripcion = $row["descripcion"];
                    $costo = $row["costo"];
                    $stock = $row["stock"];

                    // Datos obtenidos de la consulta
                    echo "
                        <div class='info$id'>
                            <div id='$id'>$id</div>
                            <div id='nombre'>$nombre</div>
                            <div id='codigo'>$codigo</div>
                            <div id='descripcion'>$descripcion</div>
                            <div id='costo'>$$costo</div>
                            <div id='stock'>$stock</div>
                            <a id='detalles' href='./productos_detalles.php?id=$id'>Ver detalles</a>
                            <a id='editar' href='./productos_editar.php?id=$id'>Editar</a>
                            <a id='eliminar' href='javascript:void(0);' onclick='eliminaAjax($id);'>Eliminar</a>
                        </div>";
                        // Los href's se cambiara en un futuro, es provicional
                }
            ?>
        </div>
    </body>