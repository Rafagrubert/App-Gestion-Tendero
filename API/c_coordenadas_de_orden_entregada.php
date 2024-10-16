<?php

include 'conexion.php';

$json=array();
    if(isset($_GET["idOrden"])){
        $idOrden=$_GET['idOrden'];

        $consulta="CALL sp_c_coordenadas_entrega('{$idOrden}')";
        $resultado=mysqli_query($conexion,$consulta);

        if($fila = mysqli_fetch_array($resultado)){
            $json['Latitud']=$fila['odLatitudEntrega'];
            $json['Longitud']=$fila['odLongitudEntrega'];
            $json['Nombre']="{$fila['perApellidos']} {$fila['perNombres']}";
            $json['HoraFecha']="{$fila['odFechaPedido']} {$fila['odHoraPedido']}";
        }
        mysqli_close($conexion);
        echo json_encode($json);
    }
?>