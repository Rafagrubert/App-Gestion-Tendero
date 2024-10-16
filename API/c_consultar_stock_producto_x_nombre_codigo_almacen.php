<?php
include 'conexion.php';
$p_idTienda=$_GET['idTienda'];
$p_idProducto=(int)$_GET['idProducto'];
$p_proDescripcion=$_GET['proDescripcion'];
$xp_modbusc=$_GET['xp_modbusc'];

$json = array();
        $consulta="call sp_c_consultar_stock_producto_x_nombre_codigo_almacen(".$p_idTienda.",".$p_idProducto.",'".$p_proDescripcion."',".$xp_modbusc.")";
        $resultado = mysqli_query($conexion,$consulta);
        while($registro = mysqli_fetch_array($resultado)){
            $result["idTienda"]=$registro['idTienda'];
            $result["idProducto"]=$registro['idProducto'];
            $result["proDescripcion"]=$registro['proDescripcion'];
            $result["lptStock"]=$registro['lptStock'];
            $result["idListadoProductoTienda"]=$registro['idListadoProductoTienda'];
            $json['consulta'][]=$result;
        }
        mysqli_close($conexion);
        echo json_encode($json);
?>
