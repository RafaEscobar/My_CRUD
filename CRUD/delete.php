<?php
    include './conex_bd.php';
    $id = $_GET['User_Id'];

    $consul_delete = "DELETE FROM usuarios WHERE User_Id='".$id."'";

    $resultado = mysqli_query($conex, $consul_delete);

    if($resultado){
        ?>
        <script>
            alert("Registro eliminado");
        </script>
        <?php
        header('Location: http://127.0.0.1/CursoPHP/MyCRUD/CRUD/panel.php');
    }else{
        echo 'OCURRIO UN GRAVE ERROR';
    }

    mysqli_close($conex);

?>