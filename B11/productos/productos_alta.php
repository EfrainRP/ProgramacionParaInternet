<html>
    <head>
        <title>Alta de empleados</title>
        <link href="./css/style_formDataEmpleado.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
        
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
                    $('#mensaje').html('Faltan campos por llenar  :(');
                    setTimeout("$('#mensaje').html('');$('#mensaje').hide();",5000);
                }else{  // Si no estan vacios los campos
                    // documment.Forma01.method = "post"; 
                    // document.Forma01.action = "./empleados_salva.php";
                    document.Forma01.submit(); //Se ejecuta el envio de los datos al archivo empleados_salva.php
                }
            }
        </script>
    </head>

    <body>
        <br><br><br>
        <!-- se manda las variables al archivo -->
        <form name="Forma01" id="Forma01" method="post" action="./productos_salva.php" enctype="multipart/form-data">
            <h1>Alta de empleados</h1>
            
            <label for ="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" placeholder="Escribe tu nombre ">

            <label for="codigo">Codigo:</label>
            <input type="text" name="codigo" id="codigo" placeholder="Escribe el codigo ">

            <label for="descripcion">Descripcion:</label>
            <!-- onfocus es cuando seleccione el elemento, onblur es cuando salgo, en los cuales puedo ejecutar una funcion-->
            <input type="text" name="descripcion" id="descripcion" placeholder="Escribe la descripcion ">
            
            <label for="costo">Costo:</label>
            <input type="int" name="costo" id="costo" placeholder="Escribe el costo ">

            <label id="stock" for="stock">Stock:</label>
            <input type="int" name="stock" id="stock" placeholder="Escribe el stock ">

            <label for="archivo" >Foto:</label>
            <input type="file" name="archivo" id="archivo"><br><br>

            <a class="opciones" id="regresar" href="./productos_lista.php">Regresar al listado</a>
            
            <input class="opciones" id="enviar" type="submit" onclick="validarCampos(); return false;" value="Enviar">
            
            <div id="mensaje"></div>
            <script>$('#mensaje').hide();</script>
            </form>
    </body>
</html>