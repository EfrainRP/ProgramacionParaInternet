<html>
    <head>
        <title>Alta de empleados</title>
        <link href="./css/style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">

        <script>
            function validar(){
                var nombre = document.Forma01.nombre.value;
                var apellidos = document.Forma01.apellidos.value;
                var correo = document.Forma01.correo.value;
                var pass = document.Forma01.pass.value;
                var rol = document.Forma01.rol.value;
                
                if(nombre == '' || apellidos == '' || correo == '' || pass == '' || rol == "0"){ //Si esta algun campo vacio
                    alert("Faltan campos por llenar :(");
                }else{  // Si no estan vacios los campos
                    // alert("Campos llenos :)");
                    // documment.Forma01.method = "post"; 
                    // document.Forma01.action = "./empleados_salva.php";
                    document.Forma01.submit();
                }
            }
        </script>
    </head>

    <body>
        <br>
        <h1>Alta de empleados</h1>
        <br>
        <br>
        <!-- se manda las variables al archivo -->
        <form name="Forma01" id="Forma01" method="post" action="./empleados_salva.php">
            <label>Nombre:</label>
            <input type="text" name="nombre" id="nombre" placeholder="Escribe tu nombre "><br> <br>
            <label>Apellidos:</label>
            <input type="text" name="apellidos" id="apellidos" placeholder="Escribe tu apellidos "><br> <br>
            <label>Correo:</label>
            <input type="text" name="correo" id="correo" placeholder="Escribe tu correo "><br> <br>
            <label>Contrasena:</label>
            <input type="text" name="pass" id="pass" placeholder="Escribe tu password "> <br> <br>
            <Label>Rol:</Label>
            <select name="rol" id="rol">
                <option value="0">Selecciona</option>
                <option value="1">Gerente</option>
                <option value="2">Ejecutivo</option>
            </select>
            <br><br>
            <!-- <div> -->
                <a class="opciones" id="regresar" href="./empleados_lista.php">Regresar</a>
                <input class="opciones" id="enviar" type="submit" onclick="validar(); return false;" value="Enviar">
                <!-- </div> -->
            </form>
    </body>
</html>