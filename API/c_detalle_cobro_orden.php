<?php

include 'conexion.php';

$json=array();
    if(isset($_GET["idOrden"])){
        $idOrden=$_GET['idOrden'];

        $consulta="CALL sp_c_detalle_cobro_orden('{$idOrden}')";
        $resultado=mysqli_query($conexion,$consulta);

        if($fila = mysqli_fetch_array($resultado)){
            $json['GananciaTienda']=$fila['odGananciaTienda'];
            $json['GananciaRepartidor']=$fila['odGananciaRepartidor'];
            $json['NombreTienda']=$fila['tieNombre'];
        }
        mysqli_close($conexion);
        echo json_encode($json);
    }
?>