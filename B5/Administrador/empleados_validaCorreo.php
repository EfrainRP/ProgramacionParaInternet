<?php //Conexion y verificacion de la base de datos
    require "./func/conecta.php";
    $con = conecta();//conecta y verifica si se hizo bien
    
    //Recibe variable
    $correo =$_REQUEST['correo'];

    $sql = "SELECT id FROM empleados WHERE correo = '$correo';"; 

    $res = $con->query($sql); //ejecuta una consulta en la conexion

    if($res == TRUE){ //Verificacion de consulta SELECT, regresando el valor del id
        if ($res->num_rows==0){
            echo $res->num_rows;
        }else{
            $row = $res->fetch_assoc(); //manda el numero de filas obtenidas del SELECT
            echo $row["id"];
        }
    }else{
        echo "Error al ejecutar la consulta: " . $con->error;
    }
    //header("Location: empleados_lista.php");
?>