<?php //Conexion y verificacion de la base de datos
    require "./func/conecta.php";
    $con = conecta();//conecta y verifica si se hizo bien
    
    //Recibe variable
    $correo =$_REQUEST['correo'];
    $pass =$_REQUEST['pass'];
    $passEnc = md5($pass); //Encripta la contraseña

    $sql = "SELECT id FROM empleados WHERE correo = '$correo' AND pass = '$passEnc' AND status = 1 AND eliminado = 0;"; //Buscamos algun id con correo repetido
    
    $res = $con->query($sql); //ejecuta una consulta en la conexion

    if($res == TRUE){ //Verificacion de consulta SELECT
        // if ($res->num_rows==0){
            echo $res->num_rows; // regresa un 0, 0 filas encontradas o id = 0
        // }else{
        //     $row = $res->fetch_assoc();
        //     echo $row["id"]; //regresa el valor del id de la consulta
        // }
    }else{
        echo "Error al ejecutar la consulta: " . $con->error;
    }
    //header("Location: empleados_lista.php");
?>