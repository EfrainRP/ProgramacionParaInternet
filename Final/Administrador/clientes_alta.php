<html>
    <head>
        <title>Alta de cliente</title>
        <link href="./css/style_formData.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
        
        <script src='../../jQuery/jquery-3.3.1.min.js'></script>
        <script>
            function validarCampos(){
                var nombre = document.Forma01.nombre.value;
                var correo = document.Forma01.correo.value;
                var pass = document.Forma01.pass.value;
                
                if(nombre == '' || correo == '' || pass == ''){ //Si esta algun campo vacio
                    $('#mensaje').show();
                    $('#mensaje').html('Faltan campos por llenar  :(');
                    setTimeout("$('#mensaje').html('');$('#mensaje').hide();",5000);
                }else{  // Si no estan vacios los campos
                    document.Forma01.submit(); //Se ejecuta el envio de los datos al archivo cliente_salva.php
                }
            }
            function validarCorreo(){
                var correo = $('#correo').val(); //Obtenemos el valor del correo del formulario
                if(correo){
                    $.ajax({ //Metodo de js para ejecutar archivos de manera asincrona
                            url: './func/clientes_validaCorreo.php', //
                            type:'post', 
                            dataType:'text',
                            data:'correo='+correo,
                            success:function(res){
                                console.log('res: '+res);
                                if(res == 0 ){//Si regresa 0, correo no repetido
                                    console.log('Correo no repetido');
                                }else if(res > 0){//Se recibe algun id por de la consulta, mayor a 0 -> correo ya existente
                                    $('#correo').val('');//Vacia el valor del input correo
                                    $('#mensajeCorreo').show();//Muestra el contenedor
                                    $('#mensajeCorreo').html('El correo <u>'+correo+'</u> ya existe.'); //Escribe el mensaje en el contenedor
                                    setTimeout("$('#mensajeCorreo').html(''); $('#mensajeCorreo').hide();", 5000);//Ejecuta esas funciones para el contenedor
                                }
                            },error:function(){
                                alert('Error archivo no encontrado...');
                            }
                        });
                }
            }
        </script>
    </head>

    <body>
        <br><br><br>
        <!-- se manda las variables al archivo -->
        <form name="Forma01" id="Forma01" method="post" action="./clientes_salva.php">
            <h1>Alta de cliente</h1>
            
            <label for ="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" placeholder="Escribe tu nombre ">

            <label for="correo">Correo:</label>
            <!-- onfocus es cuando seleccione el elemento, onblur es cuando salgo, en los cuales puedo ejecutar una funcion-->
            <input onblur="validarCorreo();" type="text" name="correo" id="correo" placeholder="Escribe tu correo ">
            
            <div id="mensajeCorreo"></div>
            
            <label for="pass">Contraseña:</label>
            <input type="password" name="pass" id="pass" placeholder="Escribe tu password "> <br><br>
            
            <a class="opciones" id="regresar" href="./clientes_login.php">Regresar</a>
            
            <input class="opciones" id="enviar" type="submit" onclick="validarCampos(); return false;" value="Enviar">
            
            <div id="mensaje"></div>
            <script>$('#mensaje').hide();$('#mensajeCorreo').hide()</script>
            </form>
    </body>
</html>