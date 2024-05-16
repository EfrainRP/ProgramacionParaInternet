<?php //Conexion y verificacion de la base de datos
    require "./func/conecta.php";
    $con = conecta();//conecta y verifica si se hizo bien
    
    //Recibe variables
    $nombre =$_REQUEST['nombre'];
    $correo =$_REQUEST['correo'];

    $pass =$_REQUEST['pass'];
    $passEnc = md5($pass); //Encripta la contraseña

    $sql = "INSERT INTO clientes (nombre,correo,pass)
            VALUES ('$nombre','$correo','$passEnc');";

    $res = $con->query($sql); //ejecuta una consulta en la conexion
    header("Location: ./../index.php");
?>