<?php //Conexion y verificacion de la base de datos
    require "./func/conecta.php";
    $con = conecta();//conecta y verifica si se hizo bien
    
    //Recibe variable
    $correo =$_REQUEST['correo'];
    $pass =$_REQUEST['pass'];
    $passEnc = md5($pass); //Encripta la contraseña

    $sql = "SELECT * FROM empleados WHERE correo = '$correo' AND pass = '$passEnc' AND status = 1 AND eliminado = 0;"; //Consulta de un correo y pass identico a lo recibido
    
    $res = $con->query($sql); //ejecuta una consulta en la conexion

    if($res == TRUE){ //Verificacion de consulta SELECT
        echo $res->num_rows; // regresa la cantidad de filas encontradas, 0 -> no encontro, !=0 encontrado
        //Usamos el propio numero de filas encontradas como banderas para la validacion de correo para el login
    }else{
        echo "Error al ejecutar la consulta: " . $con->error;
    }
    //header("Location: empleados_lista.php");
?>