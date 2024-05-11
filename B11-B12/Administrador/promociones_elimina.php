<?php //Conexion y verificacion de la base de datos
    require "./func/conecta.php";
    $con = conecta();//conecta y verifica si se hizo bien
    
    $id = $_REQUEST['id'];

    // $sql = "DELETE FROM promociones WHERE id = $id"; //elimina segun el id seleccionado

    $sql = "UPDATE promociones SET eliminado = 1 WHERE id = $id"; //Actualiza el valor eliminado a 1

    $res = $con->query($sql); //ejecuta una consulta en la conexion
    
    if($res === true){ //Verificacion de consulta
        echo $res; //manda el valor como bandera del resultado de la consulta
    }else{
        echo "Error al ejecutar la consulta: " . $con->error;
    }
    //header("Location: promociones_lista.php");
?>