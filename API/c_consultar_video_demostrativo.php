<?PHP
include 'conexion.php';
$json=array();

    $consulta="CALL sp_listar_vid_demostrativo()";
    $resultado=mysqli_query($conexion,$consulta);

    while($registro=mysqli_fetch_array($resultado)){
        //$result["idVideoDemo"]=$registro['idVideoDemo'];
        $result["videTitulo"]=$registro['videTitulo'];
        $result["videDescripcion"]=$registro['videDescripcion'];
        $result["videURL"]=$registro['videURL'];
        //$result["videEstado"]=$registro['videEstado'];
        $json['videosdemo'][]=$result;
    }
    mysqli_close($conexion);
    echo json_encode($json);

?>