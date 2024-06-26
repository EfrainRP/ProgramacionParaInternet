<?php
    require "./Administrador/func/conecta.php"; //Conexion y verificacion de la base de datos
    $con = conecta();//conecta y verifica si se hizo bien
?>
<html>
    <head>
        <title>Home</title>
        <link href="./css/style_home.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
        <script src='../jQuery/jquery-3.3.1.min.js'></script>
    </head>

    <body>
        <header>
            <?php 
                include('menu.php'); // Agrega la parte del menu en el html
                echo '<div class="banner">';
                $sql = "SELECT * FROM promociones WHERE status = 1 
                        AND eliminado = 0 ORDER BY RAND()";//Consulta a la base de datos de promociones activos y no eliminados
                $res = $con->query($sql); //ejecuta una consulta en la conexion

                $promos = $res->fetch_all(MYSQLI_ASSOC);//Tiene todas las filas de la consulta en forma de matriz
                // $indice_rand = 0;
                
                $cantidadPromos = count($promos)-1;
                do{
                    //Generamos un numero de indice para acceder a los datos
                    $indice_rand = rand(0,$cantidadPromos);
                    $last = $indice_rand;
                }
                while($indice_rand != $last);
                echo '<img src="./Administrador/archivos/'.$promos[$indice_rand]['archivo'].'">
                </div>'; 
            ?>
        </header>
        <?php
            $sql = "SELECT * FROM productos WHERE status = 1 
                    AND eliminado = 0 ORDER BY RAND() LIMIT 0,6 "; //Consulta a la base de datos de empleados activos y no eliminados

            $res = $con->query($sql); //ejecuta una consulta en la conexion
            if ($num = $res->num_rows > 0) {
                $productos = $res->fetch_all(MYSQLI_ASSOC);//Tiene todas las filas de la consulta en forma de matriz
                $totalProductos = count($productos);
            } else {
                echo "No hay productos disponibles.";
            }
            $cantidadProducto = 6;
            $totalPaginas = ceil($totalProductos / $cantidadProducto); //Redondeo la divicion, para que haya 15 productos por pagina
            for ($pagina = 1; $pagina <= $totalPaginas; $pagina++) {
                echo "<div class='productos' id='pagina$pagina'>";
                
                $indiceInicio = ($pagina - 1) * $cantidadProducto; //Variable de inicio de indice para la matriz de producto
                $indiceFin = $indiceInicio + $cantidadProducto; //Variable de fin de indice para la matriz de producto
                for ($i = $indiceInicio; $i < $indiceFin && $i < $totalProductos; $i++) {
                    // Mostreo de datos de los productos
                    echo "
                        <div id='producto".$productos[$i]['id']."'>
                            <a class='imagen' href='./productos_detalle.php?id=".$productos[$i]['id']."'><img class='imagen' src='./Administrador/archivos/".$productos[$i]['archivo']."'></a>
                            <a id='nombre' href='./productos_detalle.php?id=".$productos[$i]['id']."'><b>".$productos[$i]['nombre']."</b></a>
                            <div id='costo'>$".number_format($productos[$i]['costo'])."</div>
                            <a id='comprar' href='./productos_detalle.php?id=".$productos[$i]['id']."'>Comprar</a>
                        </div>";
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

        <footer>
            <a href="./index.php">EfraTronic.com </a>| 
            Todos los derechos reservados | 
            <a href="./politica.php">Politica de Privacidad </a>| 
            <a href="./terminos.php">Terminos y condiciones </a>
        </footer>
    </body>
</html>