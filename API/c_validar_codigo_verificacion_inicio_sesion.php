<?php
include 'conexion.php';
$json=array();
if(
    isset($_GET["sp_codvCorreo"])
&& isset($_GET["sp_codvCodigo"])
){
    $sp_codvCorreo=$_GET["sp_codvCorreo"];   
    $sp_codvCodigo=$_GET["sp_codvCodigo"];  
    $consulta="call sp_c_validar_codigo_verificacion_inicio_sesion('{$sp_codvCorreo}','{$sp_codvCodigo}');";

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

