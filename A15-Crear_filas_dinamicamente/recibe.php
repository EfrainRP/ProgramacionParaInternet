<?php
    echo '<link href="./style.css" rel="stylesheet" type="text/css">'; //Se hace referencia al css para tener el estilo
    
    echo '<a href="./index.php">Volver</a><br><br>'; //Boton de regreso al formulario

    $filas = $_POST['filas'];
    if($filas>0){ //Si es mayor a 0, generara la tabla con sus numero de fila
        echo "<table class=\"tabla\">";
        for($i=1;$i<=$filas;$i++){
            echo "<tr><td>$i</td></tr>";
        }
        echo"</table>";
    }
?>