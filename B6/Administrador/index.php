<html>
    <head>
        <title>Login</title>
        <link href="./css/style_formDataEmpleado.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">

        <script src='../../jQuery/jquery-3.3.1.min.js'></script>
        <script>
            function validarCampos(){
                var correo = $('#correo').val();
                var pass = $('#pass').val();
                
                if(correo == '' || pass == ''){ //Si esta algun campo vacio
                    $('#mensaje').show();
                    $('#mensaje').html('Faltan campos por llenar  :(');
                    setTimeout("$('#mensaje').html('');$('#mensaje').hide();",5000);
                }else{  // Si no estan vacios los campos
                    // documment.Forma01.method = "post"; 
                    // document.Forma01.action = "./empleados_salva.php";
                    $.ajax({ //Metodo de js para ejecutar archivos de manera asincrona
                        url: './empleados_validaUsuario.php', //
                        type:'post', 
                        dataType:'text',
                        data:'correo='+correo+'&pass='+pass,
                        success:function(res){
                            console.log('res: '+res);
                            if (res == 0){ //Si la respuesta es 0, NO encontro una fila con el correo
                                console.log('Correo no encontrado');
                                $('#correo').val('');//Vacia el valor del input correo
                                $('#mensaje').show();//Muestra el contenedor
                                $('#mensaje').html('Datos no correctos :('); //Escribe el mensaje en el contenedor
                                setTimeout("$('#mensajeCorreo').html(''); $('#mensajeCorreo').hide();", 5000);//Ejecuta esas funciones para el contenedor
                            }
                        },error:function(){
                            alert('Error archivo no encontrado...');
                        }
                    });
                    // document.Forma01.submit(); //Se ejecuta el envio de los datos al archivo empleados_salva.php
                }
            }
        </script>
    </head>

    <body>
        <br><br><br>
        <!-- se manda las variables al archivo -->
        <form name="Forma01" id="Forma01" method="post" action="./bienvenido.php">
            <h1>Login</h1>

            <label for="correo">Correo:</label>
            <input type="text" name="correo" id="correo" placeholder="Escribe tu correo ">
            
            <div id="mensajeCorreo"></div>
        
            <label for="pass">Contraseña:</label>
            <input type="text" name="pass" id="pass" placeholder="Escribe tu password "> <br><br>
            
            <input class="opciones" id="enviar" type="submit" onclick="validarCampos(); return false;" value="Enviar"><br><br>
            
            <div id="mensaje"></div>
            <script>$('#mensaje').hide();$('#mensajeCorreo').hide()</script>
            </form>
    </body>
</html>