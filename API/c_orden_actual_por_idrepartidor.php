<?php

include 'conexion.php';

$json=array();
    if(isset($_GET["idRepartidor"])){
        $idRepartidor=$_GET['idRepartidor'];

        $consulta="CALL sp_c_orden_actual_por_id('{$idRepartidor}')";
        $resultado=mysqli_query($conexion,$consulta);

        if($fila = mysqli_fetch_array($resultado)){
            $json['odEstado']=$fila['odEstado'];
            $json['idOrden']=$fila['idOrden'];
        }
        mysqli_close($conexion);
        echo json_encode($json);
    }
?>