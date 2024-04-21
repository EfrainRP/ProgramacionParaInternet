<?php //Conexion y verificacion de la base de datos
    require "./func/conecta.php";
    $con = conecta();//conecta y verifica si se hizo bien
    
    //Recibe variable
    $correo =$_REQUEST['correo'];

    $sql = "SELECT * FROM empleados WHERE correo = '$correo';";

    $res = $con->query($sql); //ejecuta una consulta en la conexion

    if($res == true){ //Verificacion de consulta SELECT
        echo $res->num_rows; //manda el numero de filas obtenidas del SELECT
    }else{
        echo "Error al ejecutar la consulta: " . $con->error;
    }
    //header("Location: empleados_lista.php");
?>