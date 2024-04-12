<?php //Conexion y verificacion de la base de datos
    require "funciones/conecta.php";
    $con = conecta();//conecta y verifica si se hizo bien
?>
<html>
    <head>
        <title>Lista de empleados</title>
        <link href="./style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
        <!-- evitar la caché del navegador. Genera una cadena de consulta con el tiempo actual 
        (time()) como un parámetro, lo que hace que el navegador considere cada solicitud como 
        única y no cargue la versión almacenada en caché del archivo CSS si ha cambiado.-->
    </head>
    <body>
        <?php
            $sql = "SELECT * FROM empleados
                    WHERE status = 1 AND eliminado = 0";

$res = $con->query($sql);//ejecuta una consulta en la conexion
$num = $res->num_rows;

echo "<br><h1>Lista de empleados ($num)</h1>";
?>
            <a id="crearRegistro" href="./empleados_alta.php">Crear nuevo registro</a><br><br>
            <br>
            <div class="table">
                <div class='header' id="id"><b>ID</b></div>
                <div class='header' id="nombre"><b>Nombre</b></div>
                <div class='header' id="apellidos"><b>Apellidos</b></div>
                <div class='header' id="correo"><b>Correos</b></div>
                <div class='header' id="rol"><b>Roles</b></div>
                <div class="header" id="opciones"><b>Opciones</b></div>
                
                <?php
                    while($row = $res->fetch_array()){
                        $id = $row["id"];
                        $nombre = $row["nombre"];
                        $apellidos = $row["apellidos"];
                        $correo = $row["correo"];
                        $rol = $row["rol"] == 1?"Ejecutivo":"Gerente";

                        echo "<div class='info' id='$id'>$id</div>
                            <div class='info' id='nombre'>$nombre</div>
                            <div class='info' id='apellidos'>$apellidos</div>
                            <div class='info' id='correro'>$correo</div>
                            <div class='info' id='rol'>$rol</div>
                            <a class='opciones' id='detalles' href='detalles.com'>Ver detalles</a>
                            <a class='opciones' id='editar' href='editar.com'>Editar</a>
                            <a class='opciones' id='eliminar' href='eliminar.com'>Eliminar</a>";
                            // Los href's se cambiara en un futuro, es provicional
                    }
                ?>
            </div>
    </body>