<?php
    //Definicion de parametros para la BD
    define("HOST",'localhost');
    define("BD",'d02');
    define("USER_BD",'root');
    define("PASS_BD",'');
    
    function conecta(){ //Funcion para la conexion a la BD de mysql
        $con = new mysqli(HOST, USER_BD, PASS_BD, BD); 
        return $con;
    }
?>