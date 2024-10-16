<?php
include 'conexion.php';
$json=array();
if(
    isset($_GET["sp_idDocumentoPersona"])
){
    $sp_idDocumentoPersona=$_GET["sp_idDocumentoPersona"];   
    $consulta="call sp_c_existencia_persona_inicio_sesion('{$sp_idDocumentoPersona}');";

    $resultado=mysqli_query($conexion,$consulta);

    while($registro=mysqli_fetch_array($resultado)){
        $result["idDocumentoPersona"]=$registro['idDocumentoPersona']; 
        $json['usuario'][]=$result;
    };
    mysqli_close($conexion);
    echo json_encode($json);   
}

?>

