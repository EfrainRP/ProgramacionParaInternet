<?php //Conexion y verificacion de la base de datos
    require "./func/conecta.php";
    $con = conecta();//conecta y verifica si se hizo bien
    
    //Recibe variables
    $nombre =$_REQUEST['nombre'];
    $apellidos =$_REQUEST['apellidos'];
    $correo =$_REQUEST['correo'];
    $pass =$_REQUEST['pass'];
    $passEnc = md5($pass);
    $rol =$_REQUEST['rol'];
    $archivo_n = '';
    $archivo_f = '';

    $sql = "INSERT INTO empleados (nombre,apellidos,correo,pass,rol,archivo_n,archivo)
            VALUES ('$nombre','$apellidos','$correo','$passEnc',
            $rol,'$archivo_n','$archivo_f');";

    $res = $con->query($sql); //ejecuta una consulta en la conexion
    header("Location: empleados_lista.php");
?>