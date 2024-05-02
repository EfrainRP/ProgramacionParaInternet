<?php //Conexion y verificacion de la base de datos
    require "./func/conecta.php";
    $con = conecta();//conecta y verifica si se hizo bien
    
    //Recibe variables
    $nombre =$_REQUEST['nombre'];
    $codigo =$_REQUEST['codigo'];    
    $descripcion =$_REQUEST['descripcion'];

    $costo =$_REQUEST['costo'];
    $stock =$_REQUEST['stock'];

    $archivo = $_FILES['archivo'] ['name'];//nombre real del archivo

    //Forma para determinar la extension del archivo
    // $arreglo = explode(".", $archivo);
    // $len = count($arreglo);
    // $ext = $arreglo[$len-1];

    // $dir = "./archivos/";//carpeta donde se guardan los archivos

    $sql = "INSERT INTO empleados (nombre,codigo,descripcion,costo,stock,archivo)
            VALUES ('$nombre','$codigo','$descripcion',
            $costo,$stock,'$archivo');";

    $res = $con->query($sql); //ejecuta una consulta en la conexion
    header("Location: productos_lista.php");
?>