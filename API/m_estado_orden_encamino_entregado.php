<?php

include 'conexion.php';

$json=array();
    if(isset($_GET["idOrden"])){
        $idOrden=$_GET['idOrden'];

        $consulta="CALL sp_m_estado_orden_encamino_a_entregado('{$idOrden}')";
        $resultado=mysqli_query($conexion,$consulta);
        if($fila = mysqli_fetch_array($resultado)){
            $json['odEstado']=$fila['odEstado'];
        }
        mysqli_close($conexion);
        echo json_encode($json);
    }
?>