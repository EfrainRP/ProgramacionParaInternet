<?php
    require "./func/session.php"; // Verifica que se inicio sesion
?>
<html>
    <head>
        <title>Bienvenido</title>
        <link rel="stylesheet" type="text/css" href="./css/style_list.css?v=<?php echo time(); ?>">
        <!-- El ?v=.... evitar la caché del navegador. Genera una cadena de consulta con el tiempo actual 
        (time()) como un parámetro, lo que hace que el navegador considere cada solicitud como 
        única y no cargue la versión almacenada en caché del archivo CSS si ha cambiado.-->

    </head>
    <body>
        <?php include('menu.php'); ?>
        <br><h1>Hola <?php echo $_SESSION['nombreUser']; ?>, bienvenido al sistema.</h1>
    </body>