<?php

include 'conexion.php';

$json=array();

if(isset($_GET["sp_idOrden"] ) && isset($_GET["sp_odEstado"])){

    $sp_idOrden=$_GET["sp_idOrden"];
    $sp_odEstado=$_GET["sp_odEstado"];
    
        
    $consulta="call sp_m_orden_estado_mis_ordenes( {$sp_idOrden} , '{$sp_odEstado}'  );";

    $resultado = mysqli_query($conexion,$consulta) or die (mysqli_error($conexion));

    while($registro=mysqli_fetch_array($resultado)){
        $result['esorEstado']=$registro['esorEstado']; 
        $result['esorFecha']=$registro['esorFecha']; 
        $result['esorHora']=$registro['esorHora']; 
        $json['sp_m_repartidor_por_orden_mis_ordenes'][]=$result;
    };
    
    mysqli_close($conexion);
    echo json_encode($json);
}

?>