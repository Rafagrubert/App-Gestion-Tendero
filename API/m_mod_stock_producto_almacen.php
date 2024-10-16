<?php
include 'conexion.php';
$p_idTienda=$_POST['idTienda'];
$p_idListadoProductoTienda =$_POST['idListadoProductoTienda'];
$p_lptStock =$_POST['ptStock'];


$json = array();
        $consulta="call sp_m_mod_stock_producto_almacen(".$p_idTienda.",".$p_idListadoProductoTienda.",".$p_lptStock.")";
        $resultado = mysqli_query($conexion,$consulta);

        mysqli_close($conexion);
        echo json_encode($json);
?>
