<?php
include 'conexion.php';

$json=array();



    $sp_idTienda=$_GET["sp_idTienda"];
    $sp_idOrden=$_GET["sp_idOrden"];
    $sp_odEstado=$_GET["sp_odEstado"];
    $sp_odFechaPedido=$_GET["sp_odFechaPedido"];

    $consulta="call sp_c_lista_ordenes_mis_ordenes( {$sp_idTienda} , {$sp_idOrden} , '{$sp_odEstado}', '{$sp_odFechaPedido}');";


    $resultado=mysqli_query($conexion,$consulta);

    while($registro=mysqli_fetch_array($resultado)){
        $result["idOrden"]=$registro['idOrden'];
        $result["odFechaPedido"]=$registro['odFechaPedido'];
        $result["odHoraPedido"]=$registro['odHoraPedido'];
        $result["perNombreCompleto"]=($registro['perNombreCompleto']);
        $result["odEstado"]=($registro['odEstado']);
        $result["idRepartidor"]=($registro['idRepartidor']);
        $result["repNombres"]=($registro['repNombres']);
        $json['lista_ordenes'][]=$result;
    };
    
    mysqli_close($conexion);
    echo json_encode($json);
    


?>