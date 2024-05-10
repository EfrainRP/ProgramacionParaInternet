<?php 
    require "./func/session.php"; // Verifica que se inicio sesion

    require "./func/conecta.php";//Conexion y verificacion de la base de datos
    $con = conecta();//conecta y verifica si se hizo bien
    $id = $_REQUEST['id']; //recibe el valor de la id deseado
?>

<html>
    <head>
        <title>Detalles de producto</title>
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
            <h1>Detalles de producto</h1>
            <?php
                $sql = "SELECT * FROM productos
                WHERE id = $id AND eliminado = 0";
    
                $res = $con->query($sql); //ejecuta una consulta en la conexion
            
                // Verificar la consulta echa
                if ($row = $res->fetch_array()) {
                    $id = $row["id"];
                    $nombre = $row["nombre"];
                    $codigo = $row["codigo"];
                    $descripcion = $row["descripcion"];
                    $costo = $row["costo"];
                    $stock = $row["stock"];
                    $estatus = $row["status"]==0?"Inactivo":"Activo";
                    $archivo = $row["archivo"];
                    
                    echo "
                    <div class='data'> 
                        <img id='imagen' src='./archivos/$archivo'>
                    </div>
                    
                    <div class='data'> 
                        <div id='etiqueta'>Nombre: </div>
                        <div id='info'>$nombre</div>
                    </div>

                    <div class='data'> 
                        <div id='etiqueta'>Codigo: </div>
                        <div id='info'>$codigo</div>
                    </div>
                    
                    <div class='data'> 
                        <div id='etiqueta'>Descripcion: </div>
                        <div id='info'>$descripcion</div>
                    </div>

                    <div class='data'> 
                        <div id='etiqueta'>Costo: </div>
                        <div id='info'>$costo</div>
                    </div>

                    <div class='data'> 
                        <div id='etiqueta'>Stock: </div>
                        <div id='info'>$stock</div>
                    </div>
                    <div class='data'> 
                        <div id='etiqueta'>Estatus: </div>
                        <div id='info'>$estatus</div>
                    </div>";
                } else {
                    echo "No se encontraron resultados para la ID deseado";
                }
            ?>
            <br>
            <a class="opciones" id="regresar" href="./productos_lista.php">Regresar al listado</a> <br><br>            
        </div>
    </body>
</html>