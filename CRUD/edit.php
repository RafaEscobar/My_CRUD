<?php
    include './conex_bd.php';

    if(isset($_POST['enviar'])){
        $id_update = $_POST['id_falso'];
        $nom = $_POST['nombre'];

        $consulta_up = "UPDATE usuarios SET User_nom='".$nom."'  WHERE User_Id= '".$id_update."'";

        $resul_up = mysqli_query($conex, $consulta_up);
        if($resul_up){
            ?>
                <script>
                    alert('VALORES ALMACENADOS');
                </script>
            <?php
            header('Location: http://127.0.0.1/CursoPHP/MyCRUD/CRUD/panel.php');
        }else{
            echo 'OCURRIO UN GRAVE ERROR';
        }
    }else{
        $id_A=$_GET['User_Id'];

        $consul_sel = "SELECT * FROM usuarios WHERE User_Id='".$id_A."'";
        $resul_sel = mysqli_query($conex, $consul_sel);

        $fila = mysqli_fetch_assoc($resul_sel);
        $nom_sel = $fila['User_nom'];
    }
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
    <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
        <input type="text" name="nombre" value="<?php echo $nom_sel; ?>">
        <input type="hidden" name="id_falso" value="<?php echo $id_A; ?>">
        <input type="submit" value="Actualizar" name="enviar">
    </form>
</body>
</html>