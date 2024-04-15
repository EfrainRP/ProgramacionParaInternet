<?php //Conexion y verificacion de la base de datos
    require "./func/conecta.php";
    $con = conecta();//conecta y verifica si se hizo bien
    
    $id = $_REQUEST['id'];
    // $sql = "DELETE FROM empleados WHERE id = $id";
    $sql = "UPDATE empleados SET eliminado = 1 WHERE id = $id";
    $res = $con->query($sql); //ejecuta una consulta en la conexion
    header("Location: empleados_lista.php");
?>