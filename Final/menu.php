<?php 
    session_start(); //inicia una nueva sesión o reanuda la existente
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="./css/style_menu.css?v=<?php echo time(); ?>">     
    </head>
    <body>
    <nav id="menu">
        <a class="menu" id="logo" href="./index.php"><img src="./img/logo-efratronic.jpeg"></a>
        <a class="menu" id="home" href="./index.php">Home</a>
        <a class="menu" id="productos" href="./productos.php">Productos</a>
        <a class="menu" id="contacto" href="./contacto.php">Contacto</a>
        <?php 
            if(isset($_SESSION['nombreClient'])){ //Si se inicio sesion se guarda variables de sesion
                //Variables de sesion
                $idSession = $_SESSION['idClient'];
                $nombreSession = $_SESSION['nombreClient'];
                $correoSession = $_SESSION['correoClient'];
                echo '<div>Bienvenido '.$nombreSession.'</div>
                    <a href="./Administrador/func/destroy_session.php">Cerrar sesion</a>';

                //Consultar id_pedido STATUS ABIERTO = 0
                $sql = "SELECT id FROM pedidos WHERE id_usuario = $idSession AND status = 0";
                $resPedido = $con->query($sql); //ejecuta una consulta en la conexion
                if($resPedido->num_rows > 0){
                    $row = $resPedido->fetch_assoc();

                    $sql = "SELECT id FROM pedidos_productos WHERE id_pedido = ".$row["id"];
                    $res = $con->query($sql); //ejecuta una consulta en la conexion
                    echo '<a class="menu" id="carritoMenu" href="./carrito1.php">Carrito(<span>'.$res->num_rows.'</span>)</a>';
                }
            }else{
                echo '
                <a href="./Administrador/clientes_login.php">Inicia sesion</a>
                <a class="menu" id="carritoMenu" href="./Administrador/clientes_login.php">Carrito(<span>0</span>)</a>';
            }
        ?>
    </nav>
    </body>
</html>