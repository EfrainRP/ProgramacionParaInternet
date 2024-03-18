<html>
    <head>
        <title>A15. Crear filas dinamicamente</title>
        <link href="./style.css" rel="stylesheet" type="text/css">
        <script>
            function getFila(){
                var filas = document.forma01.filas.value;
                console.log(filas);
                if(filas == 0){
                    alert("Valor invalido...");
                }
                else{
                    console.log(filas);
                    document.form01.submit(); //Se ejecuta el metodo submit para enviar los datos al formulario
                }
            }
        </script>
    </head>
    <body>
        <h1>Crear filas dinamicamente</h1>
        <br> 
        <form name="forma01" action="./recibe.php" method="POST">
            <label for="filas">Filas:</label>
            <select id="filas" name="filas">
                <option value="0" selected>Selecciona una opcion</option>; <!--Opcion ya seleccionada-->
                <?php
                    for($i=1;$i<=5000;$i++){
                        echo "<option value=\"$i\">".$i."</option>";
                    }
                ?>
            </select>
            <input type="submit" onClick="getFila(); return false;" value="Enviar con input">
        </form>
    </body>
</html>