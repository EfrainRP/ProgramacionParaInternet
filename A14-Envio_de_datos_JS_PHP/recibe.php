<?php
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $pasw = $_POST['pasw'];
    $sexo =($_POST['sexo']=='M')?'Masculino':'Femenino';
    $boletin = ($_POST['boletin']==true)? 'Recibido': 'No recibido';
    $comentario = $_POST['comentario'];
    $carreraTxt = ($_POST['carrera'] == 1)? 'Ing. Informática':' Ing. Ing. Computación';
    $promedio = $_POST['promedio'];
    $fecha =$_POST['fecha'];
    echo "Bienvenido    $nombre <br>
        Correro: $correo <br>
        Password: $pasw<br> 
        Sexo: $sexo<br>
        Boletin: $boletin<br>
        Comentario: $comentario<br>
        Carrera: $carreraTxt<br>
        Promedio: $promedio<br>
        Fecha: $fecha<br>";
        
?>