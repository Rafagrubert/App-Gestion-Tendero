<?PHP

include 'conexion.php';

$json=array();
    $consulta="CALL sp_detalle_politicas_privacidad()";
    $resultado=mysqli_query($conexion,$consulta);

    while($registro=mysqli_fetch_array($resultado)){
        $result["tecoTitulo"]=$registro['tecoTitulo'];
        $result["tecoContenido"]=$registro['tecoContenido'];
        // $result["tecoFechaInicio"]=$registro['tecoFechaInicio'];
        // $result["tecoFechaFin"]=$registro['tecoFechaFin'];
        $json['politicasprivacidad'][]=$result;
    }
    mysqli_close($conexion);
    echo json_encode($json);

?>