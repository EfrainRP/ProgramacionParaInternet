<html>
    <head>
        <title>Detalle</title>
        <link href="./css/style_form.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
        <script src='../jQuery/jquery-3.3.1.min.js'></script>
    </head>

    <body>
        <?php include('./menu.php'); ?>
        <h1>Contactanos</h1>
        <form name="Forma01" id="Forma01" method="post" action="./promociones_salva.php">            
            <label for ="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" placeholder="Escribe tu nombre ">

            <label for="correo" >Correo:</label>
            <input type="email" name="correo" id="correo" placeholder="Escribe tu correo ">

            <label for="comentarios" >Comentarios:</label>
            <textarea name="comentarios" id="comentarios" cols="32" rows="10" placeholder="Escribe tu comentario "></textarea>
            
            <input class="opciones" id="enviar" type="submit" value="Enviar">
        </form>
        <footer>
            <a href="./index.php">EfraTronic.com </a>| 
            Todos los derechos reservados | 
            <a href="./politica.php">Politica de Privacidad </a>| 
            <a href="./terminos.php">Terminos y condiciones </a>
        </footer>
    </body>
