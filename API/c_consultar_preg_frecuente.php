<?PHP
include 'conexion.php';

$json=array();
if(isset($_GET["idclaseper"])){ 
    $idclaseper =$_GET['idclaseper'];

    $consulta="CALL sp_listar_preguntas('".$idclaseper."')";
    $resultado=mysqli_query($conexion,$consulta);

    while($registro=mysqli_fetch_array($resultado)){
        //$result["idPregunta"]=$registro['idPregunta'];
        $result["prfrPregunta"]=$registro['prfrPregunta'];
        $result["prfrRespuesta"]=$registro['prfrRespuesta'];
        $result["prfrURLVideo"]=$registro['prfrURLVideo'];
        $result["prfrImagen"]=$registro['prfrImagen'];
        $json['preguntafrec'][]=$result;
    }
    mysqli_close($conexion);
    echo json_encode($json);
}

?>