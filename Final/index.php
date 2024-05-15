<?php
    require "./Administrador/func/conecta.php"; //Conexion y verificacion de la base de datos
    
    $con = conecta();//conecta y verifica si se hizo bien

    $sql = "SELECT * FROM promociones
            WHERE status = 1 AND eliminado = 0";//Consulta a la base de datos de promociones activos y no eliminados
    $res = $con->query($sql); //ejecuta una consulta en la conexion

    if ($res->num_rows > 0) {//Obtenemos la cant. de filas de la consulta
        //Guardamos el resultado de las consultas en arrays
        $ids = [];
        $nombre = [];
        $archivos = [];
        while($row = $res->fetch_assoc()) {
            $ids[] = $row["id"];
            $nombre[] = $row["nombre"];
            $archivos[] = $row["archivo"];
        }
    }
    // foreach($ids as $elem){
    //     echo $elem;
    // }
    $indice_rand = rand(0,count($ids)-1);//Generamos un numero de indice para acceder a los datos
    // $indice_rand = 0;
    // while (!in_array($indice_rand, $ids)) {
    //     $indice_rand = rand(1,$ids[$num-1]);
    // }
    // echo '<br> aray'.count($ids);
    // echo '<br> archivos '.$archivos[$indice_rand];

?>
<html>
    <head>
        <title>Home</title>
        <link href="./css/style_formData.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">

        <script src='../jQuery/jquery-3.3.1.min.js'></script>
    </head>

    <body>
        <header>
            <nav id="menu">
                <ul>
                    <li><a href="#">Inicio</a></li>
                    <li><a href="#">Acerca de</a></li>
                    <li><a href="#">Contacto</a></li>
                </ul>
            </nav>
            <h1>Home</h1>
        </header>

        <div class="dj-bg">
            <?php
                echo '<img src="./Administrador/archivos/'.$archivos[$indice_rand].'">';
            ?>
            
        </div>            
        <br><br><br>
        
    </body>
</html>