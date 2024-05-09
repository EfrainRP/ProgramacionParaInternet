<?php
     // Verifica que se inicio sesion
     session_start(); //inicia una nueva sesión o reanuda la existente

    if(isset($_SESSION['nombreUser'])){ //Si esta declarado, se inicio sesion
        header("Location: bienvenido.php");//se va al bienvenido
    }
?>
<html>
    <head>
        <title>Login</title>
        <link href="./css/style_formData.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">

        <script src='../../jQuery/jquery-3.3.1.min.js'></script>
        <script>
            function validarCampos(){
                var correo = $('#correo').val();
                var pass = $('#pass').val();
                
                if(correo == '' || pass == ''){ //Si esta algun campo vacio
                    $('#mensaje').show();
                    $('#mensaje').html('Faltan campos por llenar  :(');
                    setTimeout("$('#mensaje').html('');$('#mensaje').hide();",5000);
                }else{  // Si estan llenos los campos
                    $.ajax({ //Metodo de js para ejecutar archivos de manera asincrona
                        url: './func/validaUsuario.php', //
                        type:'post', 
                        dataType:'text',
                        data:'correo='+correo+'&pass='+pass,
                        success:function(res){
                            console.log('res: '+res);
                            if (res == 0){ //Si la respuesta es 0, NO encontro una fila con el correo y contraseña
                                console.log('Correo no encontrado');
                                $('#correo').val('');//Vacia el valor del input correo
                                $('#pass').val('');//Vacia el valor del input pass
                                $('#mensaje').show();//Muestra el contenedor
                                $('#mensaje').html('Datos no correctos :('); //Escribe el mensaje en el contenedor
                                setTimeout("$('#mensaje').html(''); $('#mensaje').hide();", 5000);//Ejecuta esas funciones para el contenedor
                            }else{//Si es diferente a 0, lo encontro
                                location.href ="./bienvenido.php"; // Redirect para mostrar la sig. pagina
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
        <form name="Forma01" id="Forma01" method="post">
            <h1>Login</h1>

            <label for="correo">Correo:</label>
            <input type="text" name="correo" id="correo" placeholder="Escribe tu correo ">
        
            <label for="pass">Contraseña:</label>
            <input type="password" name="pass" id="pass" placeholder="Escribe tu password "> <br><br>
            
            <input class="opciones" id="enviar" type="submit" onclick="validarCampos(); return false;" value="Enviar"><br><br>
            
            <div id="mensaje"></div>
            <script>$('#mensaje').hide();</script>
            </form>
    </body>
</html>