<html>
    <head>
    <link rel="stylesheet" type="text/css" href="./css/style_menu.css?v=<?php echo time(); ?>">
    </head>
    <body>
    <div id="menu">
        <a id="inicio" href="./bienvenido.php">Inicio</a>
        <a id="empleados" href="./empleados_lista.php">Empleados</a>
        <a id="productos" href="#">Productos</a>
        <a id="promociones" href="#">Promociones</a>
        <a id="pedidos" href="#">Pedidos</a>
        <span id="bienvenido"><b>Bienvenido <?php echo $_SESSION['nombreUser']; ?></b></span>
        <a id="cerrar" href="./func/destroy_session.php">Cerrar Sesion</a>
    </div>
    </body>

