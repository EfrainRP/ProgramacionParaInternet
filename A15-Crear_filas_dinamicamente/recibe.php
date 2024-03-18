<?php
    echo '<link href="./style.css" rel="stylesheet" type="text/css">'; //Se hace referencia al css para tener el estilo
    
    echo '<a href="./formularioFilas.php">Volver</a>';

    $filas = $_POST['filas'];

    echo "<table class=\"tabla\">";
    for($i=1;$i<=$filas;$i++){
        echo "<tr><td>$i</td></tr>";
    }
    echo"</table>";
?>