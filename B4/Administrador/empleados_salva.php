<?php //Conexion y verificacion de la base de datos
    require "./func/conecta.php";
    $con = conecta();//conecta y verifica si se hizo bien
    
    //Recibe variables
    $nombre =$_REQUEST['nombre'];
    $apellidos =$_REQUEST['apellidos'];
    $correo =$_REQUEST['correo'];
    
    $pass =$_REQUEST['pass'];
    $passEnc = md5($pass); //Encripta la contraseña

    $rol =$_REQUEST['rol'];
    $archivo_n = $_FILES['archivo'] ['name'];//nombre real del archivo
    $archivo_f = $_FILES['archivo'] ['tmp_name'];//nombre temporal del archivo

    //Forma para determinar la extension del archivo
    $len = count($arreglo);
    $pos = $len-1;
    $ext = $arreglo[$pos];
    $arreglo = explode(".", $archivo_n);

    $dir = "archivos/";//carpeta donde se guardan los archivos
    $file_enc = md5_file($archivo_f);//nombre del archivo encriptado

    if($archivo_n != ''){
        $fileName1 = "$file_enc.$ext";
        copy($archivo_f, $dir.$fileName1);
    }

    $sql = "INSERT INTO empleados (nombre,apellidos,correo,pass,rol,archivo_n,archivo)
            VALUES ('$nombre','$apellidos','$correo','$passEnc',
            $rol,'$archivo_n','$archivo_f');";

    $res = $con->query($sql); //ejecuta una consulta en la conexion
    header("Location: empleados_lista.php");
?>