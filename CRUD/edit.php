<?php
    /*
        Incluimos el archivo -conex_bd.php- para poder acceder a la variable $conex que genera la conexion con la BD
    */
    include './conex_bd.php';
    
    //---------------------------------------------------------------------//
    // PHP PARA ACTUALIZAR LOS DATOS

    // Validamos que se haya echo click en el btn actualizar
    if(isset($_POST['enviar'])){
        /*
            Almacenamos en una variable el id que corresponde al registro actual.
            Dicho id yace en un input oculto a la vista, de nombre 'id_falso'
        */
        $id_update = $_POST['id_falso'];
        /*
            Almacenamos en una variable lo que haya en el input 'nombre', con ayuda del array asociativo: $_POST
        */
        $nom = $_POST['nombre'];

        // GENERAMOS LA CONSULTA UPDATE PARA SUBIR A LA BD LOS NUEVOS VALORES
        /*
            >> SINTAXIS:
            UPDATE nomTabla SET nomCampo1='".$variablecampo1."', nomCampo2='".$variableCampo2."' WHERE nomCampoID = '".$variableConId."'
        */
        $consulta_up = "UPDATE usuarios SET User_nom='".$nom."'  WHERE User_Id= '".$id_update."'";

        /*
            EJECUTAMOS LA CONSULTA Y CREAMOS NUESTRA CONEXION UTILIZANDO LA VARIABLE $conex
            COMO ENLACE A LA BD. TODO ESTO CON AYUDA DE LA FUNCION: -mysqli_query-
        */
        $resul_up = mysqli_query($conex, $consulta_up);
        // Condicional -SI LA EJECUCCION DE LA CONSULTA ARROJO (true) entras al if-
        if($resul_up){
            // Al acceder al if, se han almacenado los nuevos valores en la BD, por lo que se nos re-direcciona al panel-CRUD
            header('Location: http://127.0.0.1/CursoPHP/MyCRUD/CRUD/panel.php');
        }else{
            // De no entrar al if se nos muestra un mensaje de error al actualizar los datos
            echo 'OCURRIO UN GRAVE ERROR';
        }
    }else{
        //---------------------------------------------------------------------//
        // PHP CARGAR EN EL FORMULARIO LOS DATOS ACTUALES

        // Rescatamos de la URL el ID del registro actual. ID que se envio con el principio del metodo GET. Dicho ID se almacena en una variable.
        $id_A=$_GET['Id'];

        // Generamos la consulta SELECT para obtener de la BD los registros del ID que almacenamos en el paso anterior. (ID RESCATADO DEL METODO GET)
        $consul_sel = "SELECT * FROM usuarios WHERE User_Id='".$id_A."'";

        /*
            EJECUTAMOS LA CONSULTA Y CREAMOS NUESTRA CONEXION UTILIZANDO LA VARIABLE $conex
            COMO ENLACE A LA BD. TODO ESTO CON AYUDA DE LA FUNCION: -mysqli_query-
        */
        $resul_sel = mysqli_query($conex, $consul_sel);

        // Con ayuda de la funcion -mysqli_fetch_assoc- rescatamos en una variable llamada $fila, los datos arrojados por la ejecucion de la consulta anterior.
        // Dicha variable almacena UN ARRAY ASOCIATIVO.
        $fila = mysqli_fetch_assoc($resul_sel);

        // Rescatamos del array asociativo $fila, el valor del dato, y lo almacenamos en una variable. Para cargarlo en el input posteriormente
        $nom_sel = $fila['User_nom'];
    }
    // Cerramos la conexion con la BD
    mysqli_close($conex);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
</head>
<body>
    <!-- Formulario de actualizacion de datos -->
        <!-- 
            > En action hacemos referencia al archivo actual, que es en donde se trabajan los datos rescatados de los inputs
            > Usamos metodo POST
         -->
    <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
        <!-- Cargamos en los inputs los valores correspondientes, con ayuda de las variables que almacenaron las valores, que poseee el array asociativo -->
        <input type="text" name="nombre" value="<?php echo $nom_sel; ?>">
        <!-- Este es el input oculto de nombre id_falso y el cual almacena el ID del registro actual, con el que se esta trabajando-->
        <input type="hidden" name="id_falso" value="<?php echo $id_A; ?>">
        <input type="submit" value="Actualizar" name="enviar">
    </form>
</body>
</html>