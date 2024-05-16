<?php
    require "./func/session.php"; // Verifica que se inicio sesion
    require "./func/conecta.php"; //Conexion y verificacion de la base de datos
    
    $con = conecta();//conecta y verifica si se hizo bien
    $id = $_REQUEST['id']; //recibe el valor de la id deseado
?>
<html>
    <head>
        <title>Edición de promociones</title>
        <link href="./css/style_formData.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">

        <script src='../../jQuery/jquery-3.3.1.min.js'></script>
        <script>
            function validarCampos(){
                var nombre = document.Forma01.nombre.value;
                var apellidos = document.Forma01.apellidos.value;
                var correo = document.Forma01.correo.value;
                var pass = document.Forma01.pass.value;
                var rol = document.Forma01.rol.value;
                
                if(nombre == '' || apellidos == '' || correo == '' || rol == "0"){ //Si esta algun campo vacio
                    $('#mensaje').show();
                    $('#mensaje').html('Faltan campos por llenar  :(');
                    setTimeout("$('#mensaje').html('');$('#mensaje').hide();",5000);
                }else{  // Si no estan vacios los campos
                    // documment.Forma01.method = "post"; 
                    // document.Forma01.action = "./promociones_salva.php";
                    document.Forma01.submit(); //Se ejecuta el envio de los datos al archivo promociones_salva.php
                }
            }
        </script>
    </head>

    <body>
        <?php include('menu.php'); ?><!-- Agrega la parte del menu en el html -->
        <br><br><br>
        <!-- se manda las variables al archivo -->
        <form name="Forma01" id="Forma01" method="post" action="./promociones_actualiza.php" enctype="multipart/form-data">
            <h1>Edición de promociones</h1>
            
            <?php
                $sql = "SELECT * FROM promociones
                WHERE id = $id AND eliminado = 0 AND status = 1";
    
                $res = $con->query($sql); //ejecuta una consulta en la conexion
            
                // Verificar la consulta echa
                if ($row = $res->fetch_assoc()) {//si regresa una fila, asigna valores para el formulario
                    $nombre = $row["nombre"];
                } else {//Sino encuentra id, regresa al listado
                    // echo "No se encontraron resultados para la ID deseado";
                    header("Location: promociones_lista.php"); 
                }
            ?>
            <input type="hidden" name="id" id="id" value="<?php echo $id; ?>"> <!-- Dato escondido, necesario para el formulario y el ajax-->

            <label for ="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" placeholder="Escribe tu nombre " value="<?php echo $nombre; ?>">

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