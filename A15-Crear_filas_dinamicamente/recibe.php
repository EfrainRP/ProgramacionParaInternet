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
            <label for="filas">Carrera:</label>
            <select name="filas">
                <?php
                echo "<option value="0" selected>Selecciona</option>"
                for($i=1;$i<filas;$i++){
                echo "<option value="$i" selected>Selecciona</option>"
                }

            echo "<table class=\"tabla\">";
            echo "<td>";
            for($i=0;$i<$filas;$i++){
                $letra = $letras[$i];
                $col = $i+1;
                $txt = $letra.$col;
                echo "<tr>$txt</tr>";
            }
            echo "  </td>";
            echo"<table>";
            ?>
            </select>
        </form>
    </body>
</html>