<?php
    require "./Administrador/func/conecta.php"; //Conexion y verificacion de la base de datos
    $con = conecta();//conecta y verifica si se hizo bien
?>
<html>
    <head>
        <title>Carrito</title>
        <link href="./css/style_carrito.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
        <script src='../jQuery/jquery-3.3.1.min.js'></script>
    </head>

    <body>
        <header>
            <?php 
                include('menu.php'); // Agrega la parte del menu en el html
            ?>
        </header>
        <h2>Carrito 1/2</h2>
        <?php
            if(isset($idSession)){
                $sql = "SELECT id FROM pedidos WHERE id_usuario = $idSession AND status = 0";
                $res = $con->query($sql); //ejecuta una consulta en la conexion
        
            if ($num = $res->num_rows > 0) {
                $row = $res->fetch_array();
                $id_pedido= $row['id'];

                $query = "SELECT * FROM pedidos_productos WHERE id_pedido = $id_pedido";
                $res = $con->query($sql); //ejecuta una consulta en la conexion
                $num = $res->num_rows;
                $pedidos = $res->fetch_all(MYSQLI_ASSOC);//Tiene todas las filas de la consulta en forma de matriz
                $totalPrecioFinal = 0;

            echo '<table id="carrito">
            <tr>
                <th scope="col">Producto</th>
                <th scope="col">Costo</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Subtotal</th>
                <th scope="col">Opcion</th>
            </tr>
            foreach($pedidos as $pedido){
                <tr>
                    
                </tr>
            }
            
            </table>';

            } else {
                echo "No hay productos disponibles.";
            }
        }else{
            header("Location: ./index.php");
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