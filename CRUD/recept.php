<?php
    $errores='';
    // Validamos que se haya echo click en el btn de Enviar
    if(isset($_POST['enviar'])){
        // Validamos que los campos -nombre- y -correo- contengan algo
        if(!empty($_POST['nombre']) && !empty($_POST['correo'])){
            // Guardamos en variables lo rescatado de los inputs
            $nombre = $_POST['nombre'];
            $correo = $_POST['correo'];

            // SANITIZE campos string
            $nombre = filter_var($nombre, FILTER_SANITIZE_STRING);
            // SANITIZE campo email
            $correo = filter_var($correo, FILTER_SANITIZE_EMAIL);
            // LIMPIADO GENERAL DE CAMPOS POR MEDIO DE LA FUNCION -clear_vals-
            $nombre = clear_vals($nombre);
            $correo = clear_vals($correo);

            // Condicional de validacion de email
            if(filter_var($correo, FILTER_VALIDATE_EMAIL)){
                // echo "NOMBRE: $nombre <br />" . "EMAIL: $correo";

                // HACEMOS EL LLAMADO A LA CONEXION A LA BD
                include './conex_bd.php';

                // GENERAMOS LA CONSULTA
                $consul_inset = "INSERT INTO usuarios(User_nom, User_email) VALUES('".$nombre."', '".$correo."')";

                /*
                    EJECUTAMOS LA CONSULTA Y CREAMOS NUESTRA CONEXION UTILIZANDO LA VARIABLE $conex
                    COMO ENLACE A LA BD. TODO ESTO CON AYUDA DE LA FUNCION: -mysqli_query-
                */
                $ejecucion = mysqli_query($conex, $consul_inset);
                
                /*
                    Condicional -SI LA EJECUCION DE LA CONSULTA ARROJO (TRUE)- se nos 
                    re-direcciona al panel-crud
                */
                if($ejecucion){
                    header('Location: http://127.0.0.1/CursoPHP/MyCRUD/CRUD/panel.php');
                }else{
                    /*
                        SI LA EJECUCION DE LA CONSULTA FALLO, se nos muestra un mensaje
                        de error
                    */
                    echo 'ERROR FATAL';
                }
                // Cerramos la conexion con la BD
                mysqli_close($conex);

            }else{
                // ERRROR GENERAL #3 -EMAIL NO VALIDO-
                $errores .= 'El email ingresado no es valido';
            }

            
        }else{
            // ERROR GENERAL #2 -NO SE HAN LLENADO ALGUNOS CAMPOS-
            $errores .= 'Algunos campos estan vacios. Por favor comprueba tus datos <br />';
        }
    }else{
        // ERROR GENERAL #1 -NO SE HA ENVIADO EL FORMULARIO-
        $errores .= 'NO SE HA ENVIADO NINGUN FORMULARIO <br />';
        header('Location: http://127.0.0.1/CursoPHP/MyCRUD/');
    }

    /*
        Condicional -SI LA VARIABLE GENERAL $errores NO ESTA VACIA- mostrarla por pantalla
    */
    if(!empty($errores)){
        echo $errores;
    }

    // Funcion para limpiar los valores ingresados en los inputs
    function clear_vals($variable){
        $variable = trim($variable);
        $variable = htmlspecialchars($variable);
        $variable = stripslashes($variable);

        return $variable;
    }
?>