<?php

include 'conexion.php';

$json=array();
    if(isset($_GET["idOrden"])){
        $idOrden=$_GET['idOrden'];

        $consulta="CALL sp_c_coordenadas_tienda('{$idOrden}')";
        $resultado=mysqli_query($conexion,$consulta);

        if($fila = mysqli_fetch_array($resultado)){
            $json['Latitud']=$fila['tieLatitud'];
            $json['Longitud']=$fila['tieLongitud'];
            $json['NombreTienda']=$fila['tieNombre'];
            $json['HoraFecha']="{$fila['odFechaPedido']} {$fila['odHoraPedido']}";
        }
        mysqli_close($conexion);
        echo json_encode($json);
    }
?>