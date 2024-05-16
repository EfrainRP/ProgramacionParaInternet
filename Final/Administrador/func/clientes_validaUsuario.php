<?php 
    session_start(); //inicia una nueva sesión o reanuda la existente
    
    require "./conecta.php"; //Conexion y verificacion de la base de datos
    $con = conecta();//conecta y verifica si se hizo bien
    
    //Recibe variable
    $correo =$_REQUEST['correo'];
    $pass =$_REQUEST['pass'];
    $passEnc = md5($pass); //Encripta la contraseña

    $sql = "SELECT * FROM clientes WHERE correo = '$correo' AND pass = '$passEnc';"; //Consulta de un correo y pass identico a lo recibido
    
    $res = $con->query($sql); //ejecuta una consulta en la conexion

    if($res == TRUE){ //Verificacion de consulta SELECT
        $num = $res->num_rows; //cantidad de filas encontradas
        if ($num == 1){//Encontro una consulta (la deseada), se crea la sesion
            $row = $res->fetch_array();

            $id = $row["id"];
            $nombre = $row["nombre"];
            $correo = $row["correo"];

            //Variables de sesion iniciadas
            $_SESSION['idClient'] = $id;
            $_SESSION['nombreClient'] = $nombre;
            $_SESSION['correoClient'] = $correo;
        }
        echo $num;// regresa la cantidad de filas encontradas, 0 -> no encontro, !=0 encontrado
        //Usamos el propio numero de filas encontradas como banderas para la validacion de correo para el login
    }else{
        echo "Error al ejecutar la consulta: " . $con->error;
    }
    //header("Location: clientes_lista.php");
?>