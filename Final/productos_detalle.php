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
        <script src='./js/backCarrito.js'></script>
        <script>
            function agregarProducto(id_producto,stock) {
                var cant = $('input#cantidadProducto').val();
                console.log(cant);
                if (cant > 0 && cant <= stock) {
                    $.ajax({
                    url      : './func/agregar_producto.php',
                    type     : 'post',
                    dataType : 'text',
                    data     : 'id_producto='+id_producto+'&cant='+cant,
                    success  : function(res) {
                        console.log('res: '+res);
                        if (res == 1) {
                            actualizarCarrito();
                            $('#mensaje').show();
                            $('#mensaje').html('Se ha agregado correctamente');
                            $('#mensaje').css('color','black');
                            $('#mensaje').css('border-color','#26ee07');
                            setTimeout('$("#mensaje ").html(""); $("#mensaje").hide();', 5000);
                        } else {
                            $('#mensaje').show();
                            $('#mensaje').html('Ingrese un valor valido');
                            setTimeout('$("#mensaje").html(""); $("#mensaje").hide();', 5000);
                        }

                    },error: function() {
                        alert('Error archivo no encontrado...');
                    }
                    });
                }else{
                    $('#mensaje').show();
                    $('#mensaje').html('Ingrese un valor valido');
                    setTimeout('$("#mensaje").html(""); $("#mensaje").hide();', 5000);
                }
            }
        </script>
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
                    if($url_anterior != 'productos.php' && $url_anterior != 'index.php'){
                        $url_anterior = 'index.php';
                    }
                    }

                echo "<div id='data'>
                    <img id='imagen' src='./Administrador/archivos/$archivo'>
                    <span id='nombre'><b id='label'>$nombre</b></span>
                    <span id='costo'><b id='label'>Costo:</b>$".number_format($costo)."</span>
                    <span id='codigo'><b id='label'>Codigo:</b>$codigo</span>
                    <span id='stock'><b id='label'>Stock:</b>$stock</span>
                    <p id='descripcion'><b id='label'>Descripcion:</b><br><br>$descripcion</p>";
                    if (isset($idSession)) {
                    echo "
                        <div id='cantidad'><b id='label'>Cantidad:</b>
                            <input type='number' id='cantidadProducto' value='1' min='1' max='$stock' step='1'>
                        </div>
                        <div id='mensaje'></div>
                        <script>$('#mensaje').hide();</script>
                        <a id='añadirCarrito' onclick='agregarProducto($id,$stock);'><b>Añadir a carrito</b></a>
                        <a id='comprar' href='./carrito1.php'><b>Ir a carrito</b></a>";
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
        <script>actualizarCarrito();</script>
        <footer>
            <a href="./index.php">EfraTronic.com </a>| 
            Todos los derechos reservados | 
            <a href="./politica.php">Politica de Privacidad </a>| 
            <a href="./terminos.php">Terminos y condiciones </a>
        </footer>
    </body>
</html>
