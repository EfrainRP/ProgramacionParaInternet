<?php
    $correo = $_POST['correo'];
    $pass = $_POST['pass'];
    $rol = $_POST['rol'];

    // $rol = $_GET['rol'];
    // $rol =$_REQUEST['rol'];

    $rol_txt = ($rol == 1)? 'Gerente' : 'Ejecutivo';

    echo "Bienvenido <br>";
    echo "$correo / $rol_txt";
    echo "<br><br>";

?>