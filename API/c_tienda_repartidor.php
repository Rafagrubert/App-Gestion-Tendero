<?php

include 'conexion.php';

$json=array();
    if(isset($_GET["idRepartidor"])){
        $idRepartidor=$_GET['idRepartidor'];

        $consulta="CALL sp_c_tienda_repartidor('{$idRepartidor}')";
        $resultado=mysqli_query($conexion,$consulta);

        if($fila = mysqli_fetch_array($resultado)){
            $json['Nombre']=$fila['tieNombre'];
        }
        mysqli_close($conexion);
        echo json_encode($json);
    }
?>