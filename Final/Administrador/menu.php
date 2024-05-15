<html>
    <head>
    <link rel="stylesheet" type="text/css" href="./css/style_menu.css?v=<?php echo time(); ?>">
    </head>
    <body>
    <nav id="menu">
        <a id="inicio" href="./bienvenido.php">Inicio</a>
        <a id="empleados" href="./empleados_lista.php">Empleados</a>
        <a id="productos" href="./productos_lista.php">Productos</a>
        <a id="promociones" href="./promociones_lista.php">Promociones</a>
        <a id="pedidos" href="./pedidos_lista.php">Pedidos</a>
        <span id="bienvenido"><b>Bienvenido <?php echo $nombreSession; ?></b></span>
        <a id="cerrar" href="./func/destroy_session.php">Cerrar Sesion</a>
    </nav>
    </body>

