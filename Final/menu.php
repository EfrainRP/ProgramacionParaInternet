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
            session_start(); //inicia una nueva sesión o reanuda la existente

            if(isset($_SESSION['nombreClient'])){ //Si se inicio sesion se guarda variables de sesion
                //Variables de sesion
                $idSession = $_SESSION['idClient'];
                $nombreSession = $_SESSION['nombreClient'];
                $correoSession = $_SESSION['correoClient'];
                echo '<div>Bienvenido '.$nombreSession.'</div>
                    <a href="Administrador/func/destroy_session.php">Cerrar sesion</a>';
            }else{
                echo '<a href="Administrador/clientes_login.php">Inicia sesion</a>';
            }
        ?>
        
        <a class="menu" id="carritoMenu" href="./carrito1.php">Carrito()</a>
    </nav>
    </body>
</html>