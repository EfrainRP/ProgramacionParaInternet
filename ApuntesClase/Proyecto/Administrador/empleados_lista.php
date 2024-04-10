<?php
    require "funciones/conecta.php";
    $con = conecta();//conecta y verifica si se hizo bien

    $sql = "SELECT * FROM empleados
            WHERE status = 1 AND eliminado = 0";

    $res = $con->query($sql);//ejecuta una consult en la conexion
    $num = $res->num_rows;

    echo "Lista de empleados ($num) <br><br>";

    while($row = $res->fetch_array()){
        $id = $row["id"];
        $nombre = $row["nombre"];
        $apellidos = $row["apellidos"];
        $correo = $row["correo"];
        echo "$id $nombre $apellidos $correo <br>";
    }
?>