<?php //Conexion y verificacion de la base de datos
    require "./func/conecta.php";
    $con = conecta();//conecta y verifica si se hizo bien
    
    //Recibe variables
    $nombre =$_REQUEST['nombre'];
    $archivo_n = $_FILES['archivo'] ['name'];//nombre real del archivo
    $archivo_f = $_FILES['archivo'] ['tmp_name'];//nombre temporal del archivo

    //Forma para determinar la extension del archivo
    $arreglo = explode(".", $archivo_n);
    $len = count($arreglo);
    $ext = $arreglo[$len-1];

    $dir = "./archivos/";//carpeta donde se guardan los archivos
    $file_enc = md5_file($archivo_f);//nombre del archivo encriptado

    if($archivo_n != ''){ //Verificacion de variable llena
        $fileF_Enc = "$file_enc.$ext"; //Renombrando el archivo con su respectiva extension
        copy($archivo_f, $dir.$fileF_Enc); // Copiamos y cambiamos el nombre del archivo original a la direcion definida con su respectivo nombre
    }

    $sql = "INSERT INTO promociones (nombre,archivo)
            VALUES ('$nombre', '$fileF_Enc');";

    $res = $con->query($sql); //ejecuta una consulta en la conexion
    header("Location: promociones_lista.php");
?>