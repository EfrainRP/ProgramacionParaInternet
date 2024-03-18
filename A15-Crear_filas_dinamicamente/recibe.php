<?php
        $filas = $_POST['filas'];
        echo "Filas: ".$filas." <br><br>";
    if($filas>0){
        echo "<table class=\"tabla\">";
        for($i=1;$i<=$filas;$i++){
            echo "<tr><td>$i</td></tr>";
        }
        echo"</table>";
    }
?>