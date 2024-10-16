<?php
include 'conexion.php';
$p_idTienda=$_GET['idTienda'];

$json = array();
        $consulta="call sp_c_consultar_lista_producto(".$p_idTienda.")";
        $resultado = mysqli_query($conexion,$consulta);
        while($registro = mysqli_fetch_array($resultado)){
            $result["proDescripcion"]=$registro['proDescripcion'];
            $result["lptStock"]=$registro['lptStock'];
            $json['consulta'][]=$result;
        }
        mysqli_close($conexion);
        echo json_encode($json);
?>
