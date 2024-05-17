<?php
    require "./Administrador/func/conecta.php"; //Conexion y verificacion de la base de datos
    $con = conecta();//conecta y verifica si se hizo bien
    $id = $_REQUEST['id'];
?>
<html>
    <head>
        <title>Detalle</title>
        <link href="./css/style_detail.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
        <script src='../jQuery/jquery-3.3.1.min.js'></script>
    </head>

    <body>
        <?php
            include('menu.php'); // Agrega la parte del menu en el html
            $sql = "SELECT * FROM productos WHERE id = $id 
                AND status = 1 AND eliminado = 0"; //Consulta a la base de datos de empleados activos y no eliminados

            $res = $con->query($sql); //ejecuta una consulta en la conexion
            // Verificar la consulta echa
            if ($row = $res->fetch_array()) {
                $id = $row["id"];
                $nombre = $row["nombre"];
                $codigo = $row["codigo"];
                $descripcion = $row["descripcion"];
                $costo = $row["costo"];
                $stock = $row["stock"];
                $estatus = $row["status"]==0?"Inactivo":"Activo";
                $archivo = $row["archivo"];
                
                if(isset($_SERVER['HTTP_REFERER'])) {//Obtenemos la url anterior para regresar despues con el boton REGRESAR 
                    $url_anteriorCompleto = $_SERVER['HTTP_REFERER'];
                    $arreglo = explode("/", $url_anteriorCompleto);
                    $len = count($arreglo);
                    $url_anterior = $arreglo[$len-1];//Sera index.php o productos.php
                }

                echo "<div id='data'>
                    <img id='imagen' src='./Administrador/archivos/$archivo'>
                    <span id='nombre'><b>$nombre</b></span>
                    <span id='costo'><b>Costo:</b> $".number_format($costo)."</span>
                    <span id='codigo'><b>Codigo:</b> $codigo</span>
                    <span id='stock'><b>Stock:</b> $stock</span>";
                    if (isset($idSession)) {
                    echo "
                        <div id='cantidad'><b>Cantidad:</b><input type='number' value='1' min='1' max='$stock' step='1' id='cantidad{$id}'></div>
                        <a id='comprar' href='#'><b>Comprar</b></a>";
                    }
                    echo "<a id='regresar' href='./$url_anterior'><b>Regresar</b></a></div>";
            } else {
                echo "No se encontraron resultados para la ID deseado";
            }
            $sql = "SELECT * FROM productos WHERE id != $id AND status = 1 
                AND eliminado = 0 ORDER BY RAND() LIMIT 0,3 "; //Consulta a la base de datos de empleados activos y no eliminados

            $res = $con->query($sql); //ejecuta una consulta en la conexion
            if ($num = $res->num_rows > 0) {
                $productos = $res->fetch_all(MYSQLI_ASSOC);//Tiene todas las filas de la consulta en forma de matriz
                $totalProductos = count($productos);

            echo '<div id="similares">Otros productos similares: </div>';
            echo '<div class="productos">';
            foreach($productos as $producto) {
                // Mostreo de datos de los productos
                echo "
                    <div id='producto".$producto['id']."'>
                        <a class='imagen' href='./productos_detalle.php?id=".$producto['id']."'><img id='imagen' src='./Administrador/archivos/".$producto['archivo']."'></a>
                        <div id='nombre'><b>".$producto['nombre']."</b></div>
                        <div id='costo'>$".number_format($producto['costo'])."</div>
                        <a id='comprar' href='./productos_detalle.php?id=".$producto['id']."'>Comprar</a>
                    </div>";
            }
            echo '</div>';
            } 
        ?>
        <footer>
            <a href="./index.php">EfraTronic.com </a>| 
            Todos los derechos reservados | 
            <a href="./politica.php">Politica de Privacidad </a>| 
            <a href="./terminos.php">Terminos y condiciones </a>
        </footer>
    </body>
</html>
