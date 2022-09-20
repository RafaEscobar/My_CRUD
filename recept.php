<?php
    $errores='';
    if(isset($_POST['enviar'])){
        if(!empty($_POST['nombre']) && !empty($_POST['correo'])){
            $nombre = $_POST['nombre'];
            $correo = $_POST['correo'];

            // SANITIZE campos string
            $nombre = filter_var($nombre, FILTER_SANITIZE_STRING);
            // SANITIZE campo email
            $correo = filter_var($correo, FILTER_SANITIZE_EMAIL);
            // LIMPIADO GENERAL DE CAMPOS
            $nombre = clear_vals($nombre);
            $correo = clear_vals($correo);

            // Validacion de email
            if(filter_var($correo, FILTER_VALIDATE_EMAIL)){
                // echo "NOMBRE: $nombre <br />" . "EMAIL: $correo";

                // HACEMOS EL LLAMADO A LA CONEXION A LA BD
                include './conex_bd.php';

                // GENERAMOS LA CONSULTA
                $consul_inset = "INSERT INTO usuarios(User_nom, User_email) VALUES('".$nombre."', '".$correo."')";

                // EJECUTAMOS LA CONSULTA CON LA CONEXION
                $ejecucion = mysqli_query($conex, $consul_inset);

                if($ejecucion){
                    ?>
                        <script>
                            alert('VALORES ALMACENADOS');
                        </script>
                    <?php
                }else{
                    echo 'ERROR FATAL';
                }

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
        header('Location: http://localhost/CursoPHP/CRUD/');
    }

    if(!empty($errores)){
        echo $errores;
    }

    function clear_vals($variable){
        $variable = trim($variable);
        $variable = htmlspecialchars($variable);
        $variable = stripslashes($variable);

        return $variable;
    }
?>