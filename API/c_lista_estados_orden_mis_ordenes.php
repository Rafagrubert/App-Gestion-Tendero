<?php

include 'conexion.php';

$json=array();

if(isset($_GET["sp_idOrden"] )){

    $sp_idOrden=$_GET["sp_idOrden"];
    
        
    $consulta="call sp_c_lista_estados_orden_mis_ordenes( {$sp_idOrden}  );";

    $resultado=mysqli_query($conexion,$consulta);

    while($registro=mysqli_fetch_array($resultado)){
        $result["esorEstado"]=($registro['esorEstado']);
        $result["esorFecha"]=($registro['esorFecha']);
        $result["esorHora"]=($registro['esorHora']);
        $json['sp_c_lista_estados_orden'][]=$result;
    };
       
    mysqli_close($conexion);
    echo json_encode($json);
}

?>