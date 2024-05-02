<?php //Conexion y verificacion de la base de datos
    require "./func/conecta.php";
    $con = conecta();//conecta y verifica si se hizo bien
?>
<html>
    <head>
        <title>Listado de productos</title>
        <link rel="stylesheet" type="text/css" href="./css/style_listaEmpleados.css?v=<?php echo time(); ?>">
        <!-- El ?v=.... evitar la caché del navegador. Genera una cadena de consulta con el tiempo actual 
        (time()) como un parámetro, lo que hace que el navegador considere cada solicitud como 
        única y no cargue la versión almacenada en caché del archivo CSS si ha cambiado.-->

        <script src='../../jQuery/jquery-3.3.1.min.js'></script>
        <script>
            function eliminaAjax(id){
                if(confirm("¿Seguro de que quieres eliminar este empleado?")){//Segun lo que salga en la ventana de confirmacion, ejecutara el archivo
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
        <?php //Consulta a la base de datos de empleados activos y no eliminados
            $sql = "SELECT * FROM productos
                    WHERE status = 1 AND eliminado = 0";

            $res = $con->query($sql); //ejecuta una consulta en la conexion
            $num = $res->num_rows;

            echo "<br><h1>Listado de empleados ($num)</h1>";
        ?>
        <a class='opciones' id="crearRegistro" href="./productos_alta.php"><b>Dar de alta</b></a><br><br>
        <br>
        <div class="table">
            <!-- Header de la tabla -->
            <div class='header' id="id"><b>ID</b></div>
            <div class='header' id="nombre"><b>Nombre</b></div>
            <div class='header' id="apellidos"><b>Apellidos</b></div>
            <div class='header' id="correo"><b>Correos</b></div>
            <div class='header' id="rol"><b>Roles</b></div>
            <div class="header" id="opciones"><b>Opciones</b></div>
            
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
                    <div class='info$id' id='$id'>$id</div>
                        <div class='info$id' id='nombre'>$nombre</div>
                        <div class='info$id' id='codigo'>$codigo</div>
                        <div class='info$id' id='descipcion'>$descipcion</div>
                        <div class='info$id' id='costo'>$costo</div>
                        <div class='info$id' id='stock'>$stock</div>
                        <a class='info$id' id='detalles' href='./productos_detalles.php?id=$id'>Ver detalles</a>
                        <a class='info$id' id='editar' href='./productos_editar.php?id=$id'>Editar</a>
                        <a class='info$id' id='eliminar' href='javascript:void(0);' onclick='eliminaAjax($id);'>Eliminar</a>
                        ";
                        // Los href's se cambiara en un futuro, es provicional
                }
            ?>
        </div>
    </body>