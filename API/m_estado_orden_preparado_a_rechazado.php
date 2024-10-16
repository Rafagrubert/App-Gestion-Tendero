<?php

include 'conexion.php';

$json=array();
    if(isset($_POST["idOrden"])){
        $idOrden=$_POST['idOrden'];

        $consulta="CALL sp_m_estado_orden_preparado_a_rechazado('{$idOrden}')";
        $resultado=mysqli_query($conexion,$consulta);
        mysqli_query($conexion,$consulta) or die (mysqli_error($conexion));
        mysqli_close($conexion);
    }
?>