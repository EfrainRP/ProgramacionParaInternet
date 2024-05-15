<?php 
    require "./func/session.php"; // Verifica que se inicio sesion
?>
<html>
    <head>
        <title>Alta de empleados</title>
        <link href="./css/style_formData.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
        
        <script src='../../jQuery/jquery-3.3.1.min.js'></script>
        <script>
            function validarCampos(){
                var nombre = document.Forma01.nombre.value;
                var codigo = document.Forma01.codigo.value;
                var descripcion = document.Forma01.descripcion.value;
                var costo = document.Forma01.costo.value;
                var stock = document.Forma01.stock.value;
                var archivo = document.Forma01.archivo.value;
                
                if(nombre == '' || codigo == '' || descripcion == '' || costo == '' || archivo == '' || stock == ''){ //Si esta algun campo vacio
                    $('#mensaje').show();
                    $('#mensaje').html('Faltan campos por llenar <br>o entradas no validas  :(');
                    setTimeout("$('#mensaje').html('');$('#mensaje').hide();",5000);
                }else{  // Si no estan vacios los campos
                    if(!Number.isInteger(parseFloat(codigo)) || !Number.isInteger(parseFloat(stock)) || !Number.isFloat(parseFloat(costo))){ // Comprueba si el número es un entero
                        $('#mensaje').show();
                        $('#mensaje').html('Valores numericos incorrectos');
                        setTimeout("$('#mensaje').html('');$('#mensaje').hide();",5000);
                    }else{
                        document.Forma01.submit(); //Se ejecuta el envio de los datos al archivo empleados_salva.php
                    }
                }
            }
            function validarCodigo(){
                var codigo = $('#codigo').val(); //Obtenemos el valor del codigo del formulario
                if(codigo){
                    $.ajax({ //Metodo de js para ejecutar archivos de manera asincrona
                            url: './func/validaCodigo.php', //
                            type:'post', 
                            dataType:'text',
                            data:'codigo='+codigo,
                            success:function(res){
                                console.log('res: '+res);
                                if(res == 0 ){//Si regresa 0, codigo no repetido
                                    console.log('Codigo no repetido');
                                }else if(res > 0){//Se recibe algun id por de la consulta, mayor a 0 -> codigo ya existente
                                    $('#codigo').val('');//Vacia el valor del input codigo
                                    $('#mensajeCodigo').show();//Muestra el contenedor
                                    $('#mensajeCodigo').html('El codigo <u>'+codigo+'</u> ya existe.'); //Escribe el mensaje en el contenedor
                                    setTimeout("$('#mensajeCodigo').html(''); $('#mensajeCodigo').hide();", 5000);//Ejecuta esas funciones para el contenedor
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
        <?php include('menu.php'); ?><!-- Agrega la parte del menu en el html -->
        <br><br><br>
        <!-- se manda las variables al archivo -->
        <form name="Forma01" id="Forma01" method="post" action="./productos_salva.php" enctype="multipart/form-data">
            <h1>Alta de productos</h1>
            
            <label for ="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" placeholder="Escribe tu nombre ">

            <label for="codigo">Codigo:</label>
            <input onblur="validarCodigo();" type="number" name="codigo" id="codigo" placeholder="Escribe el codigo " step="1">

            <div id="mensajeCodigo"></div>
            
            <label for="descripcion">Descripcion:</label>
            <!-- onfocus es cuando seleccione el elemento, onblur es cuando salgo, en los cuales puedo ejecutar una funcion-->
            <input type="text" name="descripcion" id="descripcion" placeholder="Escribe una descripcion ">
            
            <label for="costo">Costo:</label>
            <input type="number" name="costo" id="costo" placeholder="Escribe el costo " step="any">

            <label id="stock" for="stock">Stock:</label>
            <input type="number" name="stock" id="stock" placeholder="Escribe el stock " step="1">

            <label for="archivo" >Foto:</label>
            <input type="file" name="archivo" id="archivo"><br><br>

            <a class="opciones" id="regresar" href="./productos_lista.php">Regresar al listado</a>
            
            <input class="opciones" id="enviar" type="submit" onclick="validarCampos(); return false;" value="Enviar">
            
            <div id="mensaje"></div>
            <script>$('#mensaje').hide(); $('#mensajeCodigo').hide();</script>
            </form>
    </body>
</html>