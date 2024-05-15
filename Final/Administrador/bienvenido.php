<?php
    require "./func/session.php"; // Verifica que se inicio sesion
?>
<html>
    <head>
        <title>Sistema de Administración</title>
        <link rel="stylesheet" type="text/css" href="./css/style_list.css?v=<?php echo time(); ?>">
        
    </head>
    <body>
        <?php include('menu.php'); ?>
        <br><h1>Bienvenido <?php echo $nombreSession; ?> al Sistema de Administración.</h1>
    </body>