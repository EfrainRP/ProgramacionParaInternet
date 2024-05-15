<?php 
    require "./func/session.php"; // Verifica que se inicio sesion
?>
<html>
    <head>
        <title>Alta de promociones</title>
        <link href="./css/style_formData.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
        
        <script src='../../jQuery/jquery-3.3.1.min.js'></script>
        <script>
            function validarCampos(){
                var nombre = document.Forma01.nombre.value;
                var archivo = document.Forma01.archivo.value;
                
                if(nombre == '' || archivo == ''){ //Si esta algun campo vacio
                    $('#mensaje').show();
                    $('#mensaje').html('Faltan campos por llenar  :(');
                    setTimeout("$('#mensaje').html('');$('#mensaje').hide();",5000);
                }else{  // Si no estan vacios los campos
                    document.Forma01.submit(); //Se ejecuta el envio de los datos al archivo promociones_salva.php
                }
            }
        </script>
    </head>

    <body>
        <?php include('menu.php'); ?><!-- Agrega la parte del menu en el html -->
        <br><br><br>
        <!-- se manda las variables al archivo -->
        <form name="Forma01" id="Forma01" method="post" action="./promociones_salva.php" enctype="multipart/form-data">
            <h1>Alta de promociones</h1>
            
            <label for ="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" placeholder="Escribe tu nombre ">

            <label for="archivo" >Foto:</label>
            <input type="file" name="archivo" id="archivo">
            <br><br>
            
            <a class="opciones" id="regresar" href="./promociones_lista.php">Regresar al listado</a>          
            <input class="opciones" id="enviar" type="submit" onclick="validarCampos(); return false;" value="Enviar">
            
            <div id="mensaje"></div>
            <script>$('#mensaje').hide();</script>
            </form>
    </body>
</html>