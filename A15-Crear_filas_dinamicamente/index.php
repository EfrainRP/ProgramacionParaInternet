<html>
    <head>
        <title>A15. Crear filas dinamicamente</title>
        <link href="./style.css" rel="stylesheet" type="text/css">
        <!-- <script src="./JS/jquery-3.3.1.min.js"></script> -->
        <script>
            function getFila(){
                var filas = document.forma01.filas.value;
                console.log(filas);
                if(filas == 0){
                    alert("Valor invalido...");
                    return false;
                }
                else{
                    console.log(filas);
                    // alert(filas);
                    document.form01.submit();
                }
            }
        </script>
    </head>
    <body>
        <h1>Crear filas dinamicamente</h1>
        <br> 
        <form name="forma01" action="./recibe.php" method="POST">
            <label for="Lfilas">Filas:</label>
            <select id="filas" name="filas">
                <option value="0" selected>Selecciona</option>;
                <?php
                    // $selectNum = 5000;
                    for($i=1;$i<5000;$i++){
                        echo "<option value=\"$i\">".$i."</option>";
                    }
                ?>
            </select>
            <input type="submit" onClick="getFila(); return false;" value="Enviar con input">
        </form>
    </body>
</html>