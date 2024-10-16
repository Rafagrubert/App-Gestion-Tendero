<?php
include 'conexion.php';
function generarCodigo()
        {
            $key = '';
            $pattern = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $max = strlen($pattern)-1;
            for($i=0; $i < 6; $i++) $key .= $pattern[mt_rand(0,$max)];
            return $key;
        }
        $idCodigo = generarCodigo(); 
$json=array();
if(
  isset($_GET["sp_codvCorreo"])
    ) 
    {
$sp_codvCorreo=$_GET["sp_codvCorreo"]; 
$sp_codvCodigo= $idCodigo;

$consulta="call sp_a_registro_cod_verificacion_usuario_inicio_sesion(
'{$sp_codvCorreo}', 
'{$sp_codvCodigo}'
);";




$resultado=mysqli_query($conexion,$consulta);

while($registro=mysqli_fetch_array($resultado)){
        $result["codvCorreo"]=$registro['codvCorreo']; 
        $json['datos_usuario'][]=$result;
    };
    
    mysqli_close($conexion);
    echo json_encode($json);
  

  }

?>