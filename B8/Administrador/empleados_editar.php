<?php
    require "./func/session.php"; // Verifica que se inicio sesion
    require "./func/conecta.php"; //Conexion y verificacion de la base de datos
    $con = conecta();//conecta y verifica si se hizo bien
    $id = $_REQUEST['id']; //recibe el valor de la id deseado
?>
<html>
    <head>
        <title>Edición de empleados</title>
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
                    // document.Forma01.action = "./empleados_salva.php";
                    document.Forma01.submit(); //Se ejecuta el envio de los datos al archivo empleados_salva.php
                }
            }
            function validarCorreo(){
                var id = $('#id').val(); //Obtenemos el valor del id del formulario
                var correo = $('#correo').val(); //Obtenemos el valor del correo del formulario
                if(correo){
                    $.ajax({ //Metodo de js para ejecutar archivos de manera asincrona
                            url: './empleados_validaCorreo.php', //
                            type:'post', 
                            dataType:'text',
                            data:'correo='+correo,
                            success:function(res){
                                console.log('res: '+res);
                                if(res == 0 ){//Si regresa un 0, correo no repetido
                                    console.log('Correo no repetido');
                                }else if (res != id){ //Si es diferente el id a editar con el id recibido de la consulta sql,-> id repetido
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
        <?php include('menu.php'); ?><!-- Agrega la parte del menu en el html -->
        <br><br><br>
        <!-- se manda las variables al archivo -->
        <form name="Forma01" id="Forma01" method="post" action="./empleados_actualiza.php" enctype="multipart/form-data">
            <h1>Edición de empleados</h1>
            
            <?php
                $sql = "SELECT * FROM empleados
                WHERE id = $id AND eliminado = 0";
    
                $res = $con->query($sql); //ejecuta una consulta en la conexion
            
                // Verificar la consulta echa
                if ($row = $res->fetch_assoc()) {//si regresa una fila, asigna valores para el formulario
                    $nombre = $row["nombre"];
                    $apellidos = $row["apellidos"];
                    $correo = $row["correo"];
                    $pass = $row["pass"];
                    $rol = $row["rol"];
                } else {//Sino encuentra id, regresa al listado
                    // echo "No se encontraron resultados para la ID deseado";
                    header("Location: empleados_lista.php"); 
                }
            ?>
            <input type="hidden" name="id" id="id" value="<?php echo $id; ?>"> <!-- Dato escondido, necesario para el formulario y el ajax-->

            <label for ="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" value="<?php echo $nombre; ?>" placeholder="Escribe tu nombre ">

            <label for="apellidos">Apellidos:</label>
            <input type="text" name="apellidos" id="apellidos" value="<?php echo $apellidos; ?>" placeholder="Escribe tu apellidos ">

            <label for="correo">Correo:</label>
            <input onblur="validarCorreo();" type="text" name="correo" id="correo" value="<?php echo $correo; ?>"placeholder="Escribe tu correo ">
            
            <div id="mensajeCorreo"></div>
        
            <label for="pass">Contraseña:</label>
            <input type="password" name="pass" id="pass" placeholder="Escribe tu password "> <br><br>

            <label id="roles" for="rol">Rol:</label>
            <select name="rol" id="rol">
                <option value="0" <?php if ($rol == 0) echo 'selected="selected"';?>>Selecciona</option>
                <option value="1" <?php if ($rol == 1) echo 'selected="selected"';?>>Gerente</option>
                <option value="2" <?php if ($rol == 2) echo 'selected="selected"';?>>Ejecutivo</option>
            </select>
            <br><br>
            
            <label for="archivo" >Foto:</label>
            <input type="file" name="archivo" id="archivo"><br><br>

            <a class="opciones" id="regresar" href="./empleados_lista.php">Regresar al listado</a>
            
            <input class="opciones" id="enviar" type="submit" onclick="validarCampos(); return false;" value="Enviar"><br><br>
            
            <div id="mensaje"></div>
            <script>$('#mensaje').hide();$('#mensajeCorreo').hide()</script>
            </form>
    </body>
</html>