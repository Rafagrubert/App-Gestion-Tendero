<?php
include 'conexion.php';
$c_id_orden=$_GET['id_orden'];

$json = array();
        $consulta="CALL sp_c_detalle_orden_x_id_mis_ordenes(".$c_id_orden.")";
        $resultado = mysqli_query($conexion,$consulta);
        while($registro = mysqli_fetch_array($resultado)){
            $result["idListadoProductoTienda"]=$registro['idListadoProductoTienda'];
            $result["proDescripcion"]=$registro['lptDescripcionProductoTienda'];
            $result["doPrecioVenta"]=$registro['doPrecioVenta'];
            $result["lptImagen1"]=$registro['lptImagen1'];
            $result["proUnidadMedida"]=$registro['lptUnidadMedida'];
            $result["doCantidad"]=$registro['doCantidad'];
            $result["doSubTotal"]=$registro['doSubTotal'];
            $json['consulta'][]=$result;
        }
        mysqli_close($conexion);
        echo json_encode($json);
?>