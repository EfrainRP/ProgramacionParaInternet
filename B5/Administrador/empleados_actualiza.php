<?php //Conexion y verificacion de la base de datos
    require "./func/conecta.php";
    $con = conecta();//conecta y verifica si se hizo bien
    
    //Recibe variables
    $id = $_REQUEST['id'];
    $nombre =$_REQUEST['nombre'];
    $apellidos =$_REQUEST['apellidos'];
    $correo =$_REQUEST['correo'];
    $rol =$_REQUEST['rol'];
    
    if ($pass = $_REQUEST['pass']){ //Si esta lleno el dato de $pass
        $passEnc = md5($pass); //Encripta la contraseña
        $sql = "UPDATE empleados SET nombre = '$nombre', apellidos = '$apellidos', 
                correo = '$correo', rol = '$rol', pass = '$passEnc' WHERE id = $id"; //Realiza la consulta sql con la contaseña encriptada
    }else{
        $sql = "UPDATE empleados SET nombre = '$nombre', apellidos = '$apellidos', 
                correo = '$correo', rol = '$rol' WHERE id = $id";//Realiza la consulta sql sin la contaseña encriptada
    }

    $res = $con->query($sql); //ejecuta una consulta en la conexion

    if($res==true){ //Verificacion de consulta
        echo $res; //manda el valor como bandera del resultado de la consulta
    }else{
        echo "Error al ejecutar la consulta: " . $con->error;
    }

    header("Location: empleados_lista.php");//Regresa a la pagina
    // exit;
?>