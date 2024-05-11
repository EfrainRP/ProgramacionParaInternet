<?php 
    require "./func/session.php"; // Verifica que se inicio sesion
    require "./func/conecta.php";//Conexion y verificacion de la base de datos
    
    $con = conecta();//conecta y verifica si se hizo bien
    $id = $_REQUEST['id']; //recibe el valor de la id deseado
?>
<html>
    <head>
        <title>Edición de productos</title>
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
                
                if(nombre == '' || codigo == '' || descripcion == '' || costo == '' || stock == ''){ //Si esta algun campo vacio
                    $('#mensaje').show();
                    $('#mensaje').html('Faltan campos por llenar <br>o entradas no validas  :(');
                    setTimeout("$('#mensaje').html('');$('#mensaje').hide();",5000);
                }else{  // Si no estan vacios los campos
                    if(!Number.isInteger(parseFloat(codigo)) || !Number.isInteger(parseFloat(stock)) || isNaN(parseFloat(costo))){ // Comprueba si el número es un entero
                        $('#mensaje').show();
                        $('#mensaje').html('Valores numericos incorrectos');
                        setTimeout("$('#mensaje').html('');$('#mensaje').hide();",5000);
                    }else{
                        document.Forma01.submit(); //Se ejecuta el envio de los datos al archivo productos_salva.php
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
        <form name="Forma01" id="Forma01" method="post" action="./productos_actualiza.php" enctype="multipart/form-data">
            <h1>Edición de productos</h1>
            
            <?php
                $sql = "SELECT * FROM productos
                WHERE id = $id AND eliminado = 0 AND status = 1";
    
                $res = $con->query($sql); //ejecuta una consulta en la conexion
            
                // Verificar la consulta echa
                if ($row = $res->fetch_assoc()) {//si regresa una fila, asigna valores para el formulario
                    $id = $row["id"];
                    $nombre = $row["nombre"];
                    $codigo = $row["codigo"];
                    $descripcion = $row["descripcion"];
                    $costo = $row["costo"];
                    $stock = $row["stock"];
                } else {//Sino encuentra id, regresa al listado
                    // echo "No se encontraron resultados para la ID deseado";
                    header("Location: productos_lista.php"); 
                }
            ?>
            <input type="hidden" name="id" id="id" value="<?php echo $id; ?>"> <!-- Dato escondido, necesario para el formulario y el ajax-->

            <label for ="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" value="<?php echo $nombre; ?>" placeholder="Escribe tu nombre ">

            <label for="codigo">Codigo:</label>
            <input onblur="validarCodigo();" type="number" name="codigo" id="codigo" value="<?php echo $codigo; ?>" placeholder="Escribe el codigo " step="1">

            <div id="mensajeCodigo"></div>
            
            <label for="descripcion">Descripcion:</label>
            <!-- onfocus es cuando seleccione el elemento, onblur es cuando salgo, en los cuales puedo ejecutar una funcion-->
            <input type="text" name="descripcion" id="descripcion" value="<?php echo $descripcion; ?>" placeholder="Escribe una descripcion ">
            
            <label for="costo">Costo:</label>
            <input type="number" name="costo" id="costo" value="<?php echo $costo; ?>" placeholder="Escribe el costo " step="any">

            <label id="stock" for="stock">Stock:</label>
            <input type="number" name="stock" id="stock" value="<?php echo $stock; ?>" placeholder="Escribe el stock " step="1">

            <label for="archivo" >Foto:</label>
            <input type="file" name="archivo" id="archivo"><br><br>

            <a class="opciones" id="regresar" href="./productos_lista.php">Regresar al listado</a>
            
            <input class="opciones" id="enviar" type="submit" onclick="validarCampos(); return false;" value="Enviar">
            
            <div id="mensaje"></div>
            <script>$('#mensaje').hide(); $('#mensajeCodigo').hide();</script>
            </form>
    </body>
</html>