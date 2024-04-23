<?php //Conexion y verificacion de la base de datos
    require "./func/conecta.php";
    $con = conecta();//conecta y verifica si se hizo bien
    $id = $_REQUEST['id']; //recibe el valor de la id deseado
?>

<html>
    <head>
        <title>Detalles de empleado</title>
        <link href="./css/style_detallesEmpleado.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
    </head>

    <body>
        <br><br><br>
        <div id="contenedor">
            <h1>Detalles de empleado</h1>
            <?php
                $sql = "SELECT * FROM empleados
                WHERE id = $id AND eliminado = 0";
    
                $res = $con->query($sql); //ejecuta una consulta en la conexion
            
                // Verificar la consulta echa
                if ($res->num_rows > 0) {
                    while ($row = $res->fetch_array()) {
                        $nombre = $row["nombre"];
                        $apellidos = $row["apellidos"];
                        $correo = $row["correo"];
                        $estatus = $row["status"]==0?"Inactivo":"Activo";
                        
                        if ($row["rol"] == 1){
                            $rol = "Gerente";
                        }elseif ($row["rol"] == 2){
                            $rol = "Ejecutivo";
                        }
                        
                        echo "
                        <div id='data'> 
                            <div id='etiqueta'>Nombre completo: </div>
                            <div id='info'>$nombre $apellidos</div>
                        </div>

                        <div id='data'> 
                            <div id='etiqueta'>Correo: </div>
                            <div id='info'>$correo</div>
                        </div>
                        
                        <div id='data'> 
                            <div id='etiqueta'>Rol: </div>
                            <div id='info'>$rol</div>
                        </div>

                        <div id='data'> 
                            <div id='etiqueta'>Estatus: </div>
                            <div id='info'>$estatus</div>
                        </div>";
                    }
                } else {
                    echo "No se encontraron resultados para la ID deseado";
                }
            ?>
            <br>
            <a class="opciones" id="regresar" href="./empleados_lista.php">Regresar al listado</a> <br><br>            
        </div>
    </body>
</html>