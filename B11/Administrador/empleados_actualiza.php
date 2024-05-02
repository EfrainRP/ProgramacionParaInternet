<?php //Conexion y verificacion de la base de datos
    require "./func/conecta.php";
    $con = conecta();//conecta y verifica si se hizo bien
    
    //Recibe variables
    $id = $_REQUEST['id'];
    $nombre =$_REQUEST['nombre'];
    $apellidos =$_REQUEST['apellidos'];
    $correo =$_REQUEST['correo'];
    $rol =$_REQUEST['rol'];
    
    $sql = "UPDATE empleados SET nombre = '$nombre', apellidos = '$apellidos', correo = '$correo', rol = '$rol'"; //Consulta sql original

    if ($pass = $_REQUEST['pass']){ //Si esta lleno el dato de $pass de la contraseña
        $passEnc = md5($pass); //Encripta la contraseña
        $sql = $sql.", pass = '$passEnc'"; //Consulta sql modificada para la contraseña encriptada
    }

    if($archivo_n = $_FILES['archivo'] ['name']){//Si esta lleno la variable definida por el FILES, se ejecutara, Nombre real del archivo
        $archivo_f = $_FILES['archivo'] ['tmp_name'];//Nombre temporal del archivo

        //Forma para determinar la extension del archivo
        $arreglo = explode(".", $archivo_n);
        $len = count($arreglo);
        $ext = $arreglo[$len-1];

        $dir = "./archivos/";//Carpeta donde se guardan los archivos
        $file_enc = md5_file($archivo_f);//Nombre del archivo encriptado

        if($archivo_n != ''){//Verificacion de variable llena
            $fileF_Enc = "$file_enc.$ext"; //Renombrando el archivo con su respectiva extension
            copy($archivo_f, $dir.$fileF_Enc); // Copiamos y cambiamos el nombre del archivo original a la direcion definida con su respectivo nombre
        }
        $sql = $sql.", archivo_n = '$archivo_n', archivo = '$fileF_Enc'"; //Consulta sql modificada para los archivos
    }
    
    $sql = $sql." WHERE id = $id";//Terminacion de la consulta sql final
    $res = $con->query($sql); //Ejecucion de la consulta en la conexion a la BD

    if($res==true){ //Verificacion de consulta
        echo $res; //manda el valor como bandera del resultado de la consulta
    }else{
        echo "Error al ejecutar la consulta: " . $con->error;
    }

    header("Location: empleados_lista.php");//Regresa a la pagina
?>