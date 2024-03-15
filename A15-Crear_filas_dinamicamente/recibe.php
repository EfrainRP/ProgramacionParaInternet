<?php
    $filas = $_POST['filas'];
    $selectNum = 5000;
?>
<html>
    <head>
        <title>A15. Crear filas dinamicamente</title>
        <style>
           .ultimo{
                font-size:12px;
                color:#CCC;
            }
            .tabla{
                border:1px solid #999;
                background:#f8f8f8;
            } 
            .tabla td{
                width: 50px;
                height:50px;
                border:1px solid #999;
                text-align:center;
                color:#ff0054;
            }
        </style>
    </head>
    <body>
        <h1>Crear filas dinamicamente</h1>   
        <br><br>
        <form name="forma01" action="recibe.php" method="POST">
            <label for="filas">Filas:</label>
            <select name="filas">
                <?php
                    echo "<option value=\"0\" selected>Selecciona</option>";
                    for($i=1;$i<$selectNum;$i++){
                        echo "<option value=\"$i\">$i</option>";
                    }
                ?>
            <input type="submit" value="Enviar con input">
        </form>
            <?php
            echo "Filas: $filas <br><br>";
                if($filas>0){
                    echo "<table class=\"tabla\">";
                    for($i=1;$i<=$filas;$i++){
                        echo "<tr><td>$i</td></tr>";
                    }
                    echo"</table>";
                }
            ?>
            </select>
    </body>
</html>