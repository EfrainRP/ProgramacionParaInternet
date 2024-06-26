<?php
    require "./Administrador/func/conecta.php"; //Conexion y verificacion de la base de datos
    $con = conecta();//conecta y verifica si se hizo bien
?>
<html>
    <head>
        <title>Contacto</title>
        <link href="./css/style_form.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
        <style>
            #carga img{
                height: 2.5%;
            }
        </style>
        <script src='../jQuery/jquery-3.3.1.min.js'></script>
        <script>
        function validarCampos(){
            var correo = document.Forma01.correo.value;
            var nombre = document.Forma01.nombre.value;
            var comentarios = document.Forma01.comentarios.value;

            if (correo == "" || nombre == "" || comentarios == "") {
                $('#mensaje').show();
                $('#mensaje').html('Faltan campos por llenar');
                setTimeout("$('#mensaje').html(''); $('#mensaje').hide();", 5000);
            } else {
                $('#carga').show();
                setTimeout("$('#carga').hide();",2500);
                $.ajax({
                    url         : './func/contacto_enviar.php',
                    type        : 'post',
                    dataType    : 'text',
                    data        : 'correo='+correo+'&nombre='+nombre+'&comentarios='+comentarios,
                    success     : function(res) {
                        console.log(res);
                        if (res == 1){//Envio correcto de correo
                            $('#nombre').val('');
                            $('#correo').val('');
                            $('#comentarios').val('');

                            $('#mensaje').css("color","var(--bluePalette-color)");
                            $('#mensaje').css("border-color","var(--bluePalette-color)");
                            $('#mensaje').show();
                            $('#mensaje').html('Gracias por ponerte en contacto!');
                            setTimeout("$('#mensaje').html('');$('#mensaje').hide();",5000);
                        } else {
                            $('#mensaje').show();
                            $('#mensaje').html('Error al enviar el correo');
                            setTimeout("$('#mensaje').html('');$('#mensaje').hide();",5000);
                        }
                    },error: function() {
                        alert ('Error archivo no encontrado...');
                    }
                });
            }  
        }
        </script>
    </head>

    <body>
        <?php include('./menu.php'); ?>
        <h1>Contactanos</h1>
        <form name="Forma01" id="Forma01" method="post">            
            <label for ="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" placeholder="Escribe tu nombre ">

            <label for="correo" >Correo:</label>
            <input type="email" name="correo" id="correo" placeholder="Escribe tu correo ">

            <label for="comentarios" >Comentarios:</label>
            <textarea name="comentarios" id="comentarios" cols="32" rows="10" placeholder="Escribe tu comentario "></textarea>
            
            <div id="carga"><img src="./Administrador/archivos/loader.gif"></div>
            <div id="mensaje"></div>
            <script>$('#mensaje').hide();$('#carga').hide()</script>

            <input class="opciones" id="enviar" type="submit" onclick="validarCampos(); return false;" value="Enviar">
        </form>
        <footer>
            <a href="./index.php">EfraTronic.com </a>| 
            Todos los derechos reservados | 
            <a href="./politica.php">Politica de Privacidad </a>| 
            <a href="./terminos.php">Terminos y condiciones </a>
        </footer>
    </body>
</html>
