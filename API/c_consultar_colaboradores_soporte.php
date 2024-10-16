<?PHP

include 'conexion.php';

$json=array();
    $consulta="CALL sp_c_consultar_colaboradores_soporte()";
    $resultado=mysqli_query($conexion,$consulta);

    while($registro=mysqli_fetch_array($resultado)){
        $result["colNombres"]=$registro['colNombres'];
        $result["colCorreo"]=$registro['colCorreo'];
        $result["colRol"]=$registro['colRol'];
        $json['listarcolaboradores'][]=$result;
    }
    mysqli_close($conexion);
    echo json_encode($json);

?>