<?php

    // #1: Incluimos el llamado al archivo de conexón a BD
    include("./conex_bd.php");

    // #2: Creamos nuestra consulta para mostrar todos los datos
    $consul_select = "SELECT * FROM usuarios";

    /* #3:
        > Establecemos la conexion con la BD por medio del llamado a la variable $conex
        > Ejecutamos la consulta almacenada en la variable $consul_select
    */
    $resul_consul = mysqli_query($conex, $consul_select);
    
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/styles.css">
    <title>Panel de control</title>
</head>

<body>
    <h1>Panel de control</h1>
    <!-- Creamos una caja para nuestra tabla CRUD -->
    <div class="tabla">
        <!-- Abrimos la tabla -->
        <table>
            <!-- Establecemos una cabecera para la tabla -->
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Correo electronico</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <!-- 
                    #4: Generamos un WHILE el cual se ejecutara hasta que la funcion 
                    --mysqli_fetch_assoc-- ya no reciba ninguna fila.
                -->
                <!-- 
                    ESTE WHILE AL EJECUTARSE MUESTRA EN CADA VUELTA LOS
                    VALORES SOLICITADOS, QUE ESTE EN LA FILA DE TURNO 
                -->
                <!-- 
                    Los valores rescatados con la funcion antes mencionada, 
                    se almacenan en una variable llamada --fila--, como un 
                    array asociativo 
                -->
                    <!-- PARA GENERAR EL WHILE TENEMOS QUE ABRIR ETIQUETAS PHP -->
                <?php
                    while($fila=mysqli_fetch_assoc($resul_consul)){
                ?>
                <tr>
                    <!-- <?php //print_r($fila); ?>  --> <!-- para ver el array asociativo-->
                    <!-- 
                        #5: Con ayuda del array asociativo y el dato (el cual a su ves llama a su correspondiente valor), mostramos en la tabla los valores
                    -->
                <!-- 
                   >> EJEMPLO DE COMO SE VE EL ARRAY ASOCIATIVO
                   Array ( [User_Id] => 1 [User_nom] => Rafa [User_email] => rafa@gmail.com ) 
                   Array ( [User_Id] => 2 [User_nom] => Jaime [User_email] => jaimito@gmail.com )
                   Array ( [User_Id] => 3 [User_nom] => Balboa [User_email] => balbo@gmail.com )
                 -->
                            <!-- 
                                LOS TD SON CELDAS, Y CADA UNA REPRESENTA UN CAMPO, EN ESTE EJEMPLO TENEMOS DOS CAMPOS, -Nombre- y -Email-
                            -->
                    <td><?php echo $fila['User_nom']; ?></td>
                    <td><?php echo $fila['User_email'] ?></td>
                    <!-- 
                        #6: Enviamos manualmente con el principio del metodo GET, el valor del ID rescatado de la BD que corresponde a la fila de la cual el btn EDITAR O BORRAR haya sido pulsado.-->
                            <!-- 
                                EN CADA VUELTA EL VALOR DEL ID QUE SE RESCATA DE LA BASE DE DATOS SE ALMACENA* EN LA URL QUE SE CONTRUYE AQUI EN CADA BTN  
                            -->
                    <td>
                        <?php echo "<a href='../CRUD/edit.php?User_Id=".$fila['User_Id']."'>EDITAR</a>"; ?>
                    </td>
                    <td>
                        <?php echo "<a href='../CRUD/delete.php?User_Id=".$fila['User_Id']."'>ELIMINAR</a>"; ?>
                    </td>
                </tr>

                <!-- #7: CERRAMOS LA LLAVE DEL WHILE, Y PARA ESO ABRIMOS ETIQUETAS PHP-->
                <?php
                    }
                ?>
            </tbody>
        </table>
        <?php
        // #8: Cerramos la conexion con la base de datos
            mysqli_close($conex);
        ?>
    </div>
</body>

</html>