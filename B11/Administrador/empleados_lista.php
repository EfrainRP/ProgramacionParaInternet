<?php 
    require "./func/session.php"; // Verifica que se inicio sesion
    
    require "./func/conecta.php"; //Conexion y verificacion de la base de datos
    $con = conecta();//conecta y verifica si se hizo bien
?>
<html>
    <head>
        <title>Listado de empleados</title>
        <link rel="stylesheet" type="text/css" href="./css/style_list.css?v=<?php echo time(); ?>">
        <!-- El ?v=.... evitar la caché del navegador. Genera una cadena de consulta con el tiempo actual 
        (time()) como un parámetro, lo que hace que el navegador considere cada solicitud como 
        única y no cargue la versión almacenada en caché del archivo CSS si ha cambiado.-->

        <script src='../../jQuery/jquery-3.3.1.min.js'></script>
        <script>
            function eliminaAjax(id){
                if(confirm("¿Seguro de que quieres eliminar este empleado?")){//Segun lo que salga en la ventana de confirmacion, ejecutara el archivo
                    $.ajax({ //Metodo de js para ejecutar archivos de manera asincrona
                        url: './empleados_elimina.php', //
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
            $sql = "SELECT * FROM empleados
                    WHERE status = 1 AND eliminado = 0";//Consulta a la base de datos de empleados activos y no eliminados

            $res = $con->query($sql); //ejecuta una consulta en la conexion
            $num = $res->num_rows;

            echo "<br><h1>Listado de empleados ($num)</h1>";
        ?>
        <a class='opciones' id="crearRegistro" href="./empleados_alta.php"><b>Dar de alta</b></a><br><br>
        <br>
        <div class="table">
            <!-- Header de la tabla -->
            <div class='header'>
                <div id="id"><b>ID</b></div>
                <div id="nombre"><b>Nombre</b></div>
                <div id="apellidos"><b>Apellidos</b></div>
                <div id="correo"><b>Correos</b></div>
                <div id="rol"><b>Roles</b></div>
                <div id="opciones"><b>Opciones</b></div>
            </div>
            
            <?php
                /*fetch_array nos recupera una fila de resultados 
                como una matriz asociativa de la consulta*/
                while($row = $res->fetch_array()){ 
                    $id = $row["id"];
                    $nombre = $row["nombre"];
                    $apellidos = $row["apellidos"];
                    $correo = $row["correo"];

                    if ($row["rol"] == 1){
                        $rol = "Gerente";
                    }elseif ($row["rol"] == 2){
                        $rol = "Ejecutivo";
                    }

                    // Datos obtenidos de la consulta
                    echo "
                    <div class='info$id'>
                        <div id='id'>$id</div>
                        <div id='nombre'>$nombre</div>
                        <div id='apellidos'>$apellidos</div>
                        <div id='correro'>$correo</div>
                        <div id='rol'>$rol</div>
                        <a id='detalles' href='./empleados_detalles.php?id=$id'>Ver detalles</a>
                        <a id='editar' href='./empleados_editar.php?id=$id'>Editar</a>
                        <a id='eliminar' href='javascript:void(0);' onclick='eliminaAjax($id);'>Eliminar</a>
                    </div>";
                        // Los href's se cambiara en un futuro, es provicional
                }
            ?>
        </div>
    </body>