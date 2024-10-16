<?php
include 'conexion.php';
$json=array();
if(isset($_GET["sp_codvCorreo"])){
    $sp_codvCorreo=$_GET["sp_codvCorreo"];   
    $consulta="call sp_c_estado_usuario_inicio_sesion('{$sp_codvCorreo}');";

    $resultado=mysqli_query($conexion,$consulta);

    while($registro=mysqli_fetch_array($resultado)){
        $result["codvCorreo"]=$registro['codvCorreo']; 
        $result["codvCodigo"]=$registro['codvCodigo']; 
        $json['usuario'][]=$result;
    };
    mysqli_close($conexion);
    echo json_encode($json);   
}

?>

