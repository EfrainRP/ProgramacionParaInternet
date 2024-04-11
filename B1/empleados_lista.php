<html>
    <head>
        <title>Lista de empleados</title>
        <?php //Conexion y verificacion de la base de datos
            require "funciones/conecta.php";
            $con = conecta();//conecta y verifica si se hizo bien
        ?>
        <link href="./style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <?php
            $sql = "SELECT * FROM empleados
                    WHERE status = 1 AND eliminado = 0";

$res = $con->query($sql);//ejecuta una consulta en la conexion
$num = $res->num_rows;

echo "<h1>Lista de empleados ($num)</h1><br>";
?>
            <a href="./empleados_alta.php">Crear nuevo registro</a><br><br>
            <div class="table">
                <div class='header' id="id"><b>ID</b></div>
                <div class='header' id="nombre"><b>Nombre</b></div>
                <div class='header' id="apellidos"><b>Apellidos</b></div>
                <div class='header' id="correo"><b>Correos</b></div>
                <div class='header' id="rol"><b>Roles</b></div>
                <div class="header" id="opciones"><b>Opiones</b></div>
                
                <?php
                    while($row = $res->fetch_array()){
                        $id = $row["id"];
                        $nombre = $row["nombre"];
                        $apellidos = $row["apellidos"];
                        $correo = $row["correo"];
                        $rol = $row["rol"];

                        echo "<div class='info'             id='id'>$id</div>
                            <div class='info' id='nombre'>$nombre</div>
                            <div class='info' id='apellidos'>$apellidos</div>
                            <div class='info' id='correro'>$correo</div>
                            <div class='info' id='rol'>$rol</div>
                            <div class='info' id='detalles'>Ver detalles</div>
                            <div class='info' id='editar'>Editar</div>
                            <div class='info' id='eliminar'>Eliminar</div>";
                        // echo "$id $nombre $apellidos $correo <br>";
                    }
                ?>
            </div>
    </body>