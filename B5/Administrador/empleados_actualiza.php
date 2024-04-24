<?php //Conexion y verificacion de la base de datos
    require "./func/conecta.php";
    $con = conecta();//conecta y verifica si se hizo bien
    
    //Recibe variables
    $id = $_REQUEST['id'];
    $nombre =$_REQUEST['nombre'];
    $apellidos =$_REQUEST['apellidos'];
    $correo =$_REQUEST['correo'];
    $rol =$_REQUEST['rol'];
    
    if ($pass = $_REQUEST['pass']){ //Si esta lleno el dato
        $passEnc = md5($pass); //Encripta la contraseña
        $sql = "UPDATE empleados SET nombre = '$nombre', apellidos = '$apellidos', 
                correo = '$correo', rol = '$rol', pass = '$passEnc' WHERE id = $id";
    }else{
        $sql = "UPDATE empleados SET nombre = '$nombre', apellidos = '$apellidos', 
                correo = '$correo', rol = '$rol' WHERE id = $id";
    }
    // //Si esta lleno 
    // if($archivo_n = $_FILES['archivo'] ['name']){//nombre real del archivo
    //     $archivo_f = $_FILES['archivo'] ['tmp_name'];//nombre temporal del archivo
        
    //     //Forma para determinar la extension del archivo
    //     $len = count($arreglo);
    //     $pos = $len-1;
    //     $ext = $arreglo[$pos];
    //     $arreglo = explode(".", $archivo_n);
    
    //     $dir = "archivos/";//carpeta donde se guardan los archivos
    //     $file_enc = md5_file($archivo_f);//nombre del archivo encriptado
    
    //     if($archivo_n != ''){
    //         $fileName1 = "$file_enc.$ext";
    //         copy($archivo_f, $dir.$fileName1);
    //     }
    // }

    $res = $con->query($sql); //ejecuta una consulta en la conexion

    if($res==true){ //Verificacion de consulta
        echo $res; //manda el valor como bandera del resultado de la consulta
    }else{
        echo "Error al ejecutar la consulta: " . $con->error;
    }

    header("Location: empleados_lista.php");
    // exit;
?>