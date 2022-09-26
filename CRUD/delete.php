<?php
    /*
        Incluimos el archivo -conex_bd.php- para poder acceder a la variable $conex que genera la conexion con la BD
    */
    include './conex_bd.php';
    // Rescatamos de la URL el ID del registro actual. ID que se envio con el principio del metodo GET. Dicho ID se almacena en una variable.
    $id_del = $_GET['Id'];

    // Generamos la consulta DELETE borrar el registro actual
    /*
        >> SINTAXIS:
        DELETE FROM nomTabla WHERE nomCampoID = '".$variableConId."'
    */
    $consul_delete = "DELETE FROM usuarios WHERE User_Id='".$id_del."'";

    /*
        Ejecutamos la consulta con ayuda de la funcion -mysqli_query- y la variable $conex la cual establece la conexion con la BD
    */
    $resultado = mysqli_query($conex, $consul_delete);

    // Condicional -SI LA EJECUCION DE LA CONSULTA ARROJO (true) entramos al if-
    if($resultado){
        // Al entrar a este if ya se ha eliminado el el registro por lo que se nos re-direcciona al panel-crud
        header('Location: http://127.0.0.1/CursoPHP/MyCRUD/CRUD/panel.php');
    }else{
        // Si la ejecucion de la consulta fallo se mostrara un mensaje de error
        echo 'OCURRIO UN GRAVE ERROR';
    }
    
    // Cerramos la conexion con la BD
    mysqli_close($conex);

?>