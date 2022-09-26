<?php
    // GENERAMOS LA CONEXION CON BASE DE DATOS MEDIANTE LA FUNCION -mysqli- y la palabra reservada -this-
    /*
        >> Sintaxis de la variable de conexion
        $nomVariable = new mysqli('IP', 'noUsuario', 'password', 'nombreBD');
    */
    $conex = new mysqli('localhost', 'root', '', 'mybd');

?>