<?php

include 'conexion.php';

$json=array();

if(isset($_GET["sp_idTienda"] )){

    $sp_idTienda=$_GET["sp_idTienda"];
    
        
    $consulta="call sp_c_lista_repartidor_orden_mis_ordenes( {$sp_idTienda}  );";

    $resultado=mysqli_query($conexion,$consulta);

    while($registro=mysqli_fetch_array($resultado)){
        $result["idRepartidor"]=($registro['idRepartidor']);
        $result["perNombreCompleto"]=($registro['perNombreCompleto']);
        $json['sp_c_lista_repartidor_orden'][]=$result;
    };
       
    mysqli_close($conexion);
    echo json_encode($json);
}

?>