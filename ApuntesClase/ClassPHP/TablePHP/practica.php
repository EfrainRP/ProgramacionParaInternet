<?php
    require "libreria/funciones.php";

    $usuario = "Ruben Mandonado";
    $hoy = date('d').' de '.getMes(date('m')).' del '.date('Y');
    $columnas = 8;
    $letras = ['A','B','C','D','E','F','G','H'];
?>
<html>
    <head>
        <title>Practica PHP</title>
        <style>
            .ultimo{
                font-size:12px;
                color:#CCC;
            }
            .tablaA{
                border:1px solid #999;
                background:#f8f8f8;
            } 
            .tablaA td{
                widtyh: 50px;
                height:50px;
                border:1px solid #999;
                text-align:center;
                color:#ff0054;
            }
        </style>
    </head>
    <body>
        <?php
            echo "Bienvenido $usuario <br><br>";
            echo '<div style="margin-bottom:25px;">
                    Ultimo acceso:
                    <span class="ultimo">'.$hoy.'</span>
                    </div>';
            echo "<table class=\"tablaA\">";
            echo "   <tr>";
            for($i=0;$i<$columnas;$i++){
                $letra = $letras[$i];
                $col = $i+1;
                $txt = $letra.$col;
                echo "<td>$txt</td>";
            }
            echo "  </tr>";
            echo"<table>";
        ?>
    </body>
</html>