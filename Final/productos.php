<?php
    require "./Administrador/func/conecta.php"; //Conexion y verificacion de la base de datos
    $con = conecta();//conecta y verifica si se hizo bien
?>
<html>
    <head>
        <title>Productos</title>
        <link href="./css/style_home.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
        <script src='../jQuery/jquery-3.3.1.min.js'></script>
    </head>

    <body>
        <?php
            include('menu.php'); // Agrega la parte del menu en el html
            $sql = "SELECT * FROM productos
                    WHERE status = 1 AND eliminado = 0"; //Consulta a la base de datos de empleados activos y no eliminados

            $res = $con->query($sql); //ejecuta una consulta en la conexion
            if ($num = $res->num_rows > 0) {
                $productos = $res->fetch_all(MYSQLI_ASSOC);//Tiene todas las filas de la consulta en forma de matriz
                $totalProductos = count($productos);
            } else {
                echo "No hay productos disponibles.";
            }
            $cantidadProducto = 18;
            $totalPaginas = ceil($totalProductos / $cantidadProducto); //Redondeo la divicion, para que haya 15 productos por pagina
            for ($pagina = 1; $pagina <= $totalPaginas; $pagina++) {
                echo "<div class='productos' id='pagina$pagina'>";
                
                $indiceInicio = ($pagina - 1) * $cantidadProducto; //Variable de inicio de indice para la matriz de producto
                $indiceFin = $indiceInicio + $cantidadProducto; //Variable de fin de indice para la matriz de producto

                for ($i = $indiceInicio; $i < $indiceFin && $i < $totalProductos; $i++) {
                    // Mostreo de datos de los productos
                    echo "
                        <div id='producto".$productos[$i]['id']."'>
                            <img id='imagen' src='./Administrador/archivos/".$productos[$i]['archivo']."'>
                            <div id='nombre'><b>".$productos[$i]['nombre']."</b></div>
                            <div id='costo'>$".number_format($productos[$i]['costo'])."</div>
                            <a id='detalles' href='./productos_detalle.php?id=".$productos[$i]['id']."'>Detalles</a>
                            <a id='agregar' href='#'>Agregar <b>(".$productos[$i]['stock'].")</b></a>
                            </div>
                        ";
                }
                echo "</div>";
            }
        ?>
        <div class="paginacion">
            <?php for ($i = 1; $i <= $totalPaginas; $i++) {
                    echo "<a href='#' id='pagina$i' onclick='mostrarPagina($i)'>$i</a>";
                } ?>
        </div>

        <script src="./js/paginacion.js"></script> <!-- archivo para la paginacion -->
    </body>
</html>