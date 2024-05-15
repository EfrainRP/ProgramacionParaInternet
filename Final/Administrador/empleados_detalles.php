<?php 
    require "./func/session.php"; // Verifica que se inicio sesion
    require "./func/conecta.php";//Conexion y verificacion de la base de datos
    $con = conecta();//conecta y verifica si se hizo bien
    $id = $_REQUEST['id']; //recibe el valor de la id deseado
?>

<html>
    <head>
        <title>Detalles de empleado</title>
        <link href="./css/style_details.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
    </head>

    <body>
        <?php include('menu.php'); ?><!-- Agrega la parte del menu en el html -->
        <br><br><br>
        <div id="contenedor">
            <h1>Detalles de empleado</h1>
            <?php
                $sql = "SELECT * FROM empleados
                WHERE id = $id AND eliminado = 0";
    
                $res = $con->query($sql); //ejecuta una consulta en la conexion
            
                // Verificar la consulta echa
                if ($row = $res->fetch_array()) {
                        $nombre = $row["nombre"];
                        $apellidos = $row["apellidos"];
                        $correo = $row["correo"];
                        $estatus = $row["status"]==0?"Inactivo":"Activo";
                        $archivo = $row["archivo"];
                        
                        if ($row["rol"] == 1){
                            $rol = "Gerente";
                        }elseif ($row["rol"] == 2){
                            $rol = "Ejecutivo";
                        }
                        
                        echo "
                        <div class='data'> 
                            <img id='imagen' src='./archivos/$archivo'>
                        </div>
                        
                        <div class='data'> 
                            <div id='etiqueta'>Nombre completo: </div>
                            <div id='info'>$nombre $apellidos</div>
                        </div>

                        <div class='data'> 
                            <div id='etiqueta'>Correo: </div>
                            <div id='info'>$correo</div>
                        </div>
                        
                        <div class='data'> 
                            <div id='etiqueta'>Rol: </div>
                            <div id='info'>$rol</div>
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
            <a class="opciones" id="regresar" href="./empleados_lista.php">Regresar al listado</a> <br><br>            
        </div>
    </body>
</html>