<?PHP

include 'conexion.php';

$json=array();
    $consulta="CALL sp_detalle_produc_prohibidos()";
    $resultado=mysqli_query($conexion,$consulta);

    while($registro=mysqli_fetch_array($resultado)){
        $result["tecoTitulo"]=$registro['tecoTitulo'];
        $result["tecoContenido"]=$registro['tecoContenido'];
        $json['producprohibido'][]=$result;
    }
    mysqli_close($conexion);
    echo json_encode($json);

?>