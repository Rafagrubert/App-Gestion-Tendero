<?PHP

include 'conexion.php';

$json=array();
    $consulta="CALL sp_detalle_terms_condiciones_uso()";
    $resultado=mysqli_query($conexion,$consulta);

    while($registro=mysqli_fetch_array($resultado)){
        $result["tecoTitulo"]=$registro['tecoTitulo'];
        $result["tecoContenido"]=$registro['tecoContenido'];
        $json['termscondicionesuso'][]=$result;
    }
    mysqli_close($conexion);
    echo json_encode($json);

?>