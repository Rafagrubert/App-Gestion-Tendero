<?php

include 'conexion.php';

$json=array();

if(isset($_GET["sp_idOrden"] ) && isset($_GET["sp_idRepartidor"])){

    $sp_idOrden=$_GET["sp_idOrden"];
    $sp_idRepartidor=$_GET["sp_idRepartidor"];
    
        
    $consulta="call sp_m_repartidor_por_orden_mis_ordenes( {$sp_idOrden} , '{$sp_idRepartidor}'  );";
    
    $resultado = mysqli_query($conexion,$consulta) or die (mysqli_error($conexion));

    while($registro=mysqli_fetch_array($resultado)){
        $result["perNombreCompleto"]=$registro['perNombreCompleto']; 
        $json['sp_m_repartidor_por_orden_mis_ordenes'][]=$result;
    };
    
    mysqli_close($conexion);
    echo json_encode($json);
}

?>