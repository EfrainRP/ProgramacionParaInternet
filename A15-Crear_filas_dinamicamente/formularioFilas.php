<html>
    <head>
        <title>A15. Crear filas dinamicamente</title>
        <link rel="stylesheet" href=".\styleForm.css"> <!-- Se conecta el archivo CSS para los estilos-->
        <!-- <script src="./JS/jquery-3.3.1.min.js"></script> -->
        <script>
            function getFila(){
                var filas = document.forma01.filas.value;
                console.log(filas);
                if(filas == 0){
                    alert("Valor invalido...");
                    console.log(filas);
                    return false;
                }
                else{
                    alert(filas);
                    return true;
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
                <option value="0" selected>Selecciona</option>;
                <?php
                    // $selectNum = 5000;
                    for($i=1;$i<5000;$i++){
                        echo "<option value=\"$i\">".$i."</option>";
                    }
                ?>
            </select>
            <input type="submit" onClick="getFila();" value="Enviar con input">
        </form>
    </body>
</html>