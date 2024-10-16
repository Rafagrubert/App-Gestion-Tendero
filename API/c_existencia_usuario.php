<?php

include 'conexion.php';

$json=array();

if(isset($_GET["sp_usuCorreo"])){


    $sp_usuCorreo=$_GET["sp_usuCorreo"];

            
    $consulta="CALL sp_c_existencia_usuario('{$sp_usuCorreo}');";
    
    $resultado=mysqli_query($conexion,$consulta);

    while($registro=mysqli_fetch_array($resultado)){
        $result["idUsuario"]=$registro['idUsuario']; 
        $json['usuario'][]=$result;
    };
    
    mysqli_close($conexion);
    echo json_encode($json);
    
}

?>
