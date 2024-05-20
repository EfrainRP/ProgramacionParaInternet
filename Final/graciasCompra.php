<?php
    require "./Administrador/func/conecta.php"; //Conexion y verificacion de la base de datos
    $con = conecta();//conecta y verifica si se hizo bien
?>
<html>
    <head>
        <title>Gracias</title>
        <link href="./css/style_carrito.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
        <script src='../jQuery/jquery-3.3.1.min.js'></script>
        <script src='./js/backCarrito.js'></script>
    </head>
    <style>
        #btnContinuar{
            justify-content:center;
        }
    </style>
    <body>
        <header>
            <?php 
                include('menu.php'); // Agrega la parte del menu en el html
            ?>
        </header>
        <h1>Gracias por su compra</h1>
        <div id="btnContinuar">
            <a id="continuar"  href="./index.php">Seguir comprando</a>
        </div>
        <footer>
            <a href="./index.php">EfraTronic.com </a>| 
            Todos los derechos reservados | 
            <a href="./politica.php">Politica de Privacidad </a>| 
            <a href="./terminos.php">Terminos y condiciones </a>
        </footer>
    </body>
</html>