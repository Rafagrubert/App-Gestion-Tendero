<?php
include 'conexion.php';

$json=array();
    if(isset($_GET["idOrden"])){
        $idOrden=$_GET['idOrden'];
        $consulta="CALL sp_c_datos_y_productos_orden('{$idOrden}')";
        $resultado=mysqli_query($conexion,$consulta);
        while($fila = mysqli_fetch_array($resultado)){
            $json['idOrden']= $fila['idOrden'];
            $json['HoraFechaInicial']="{$fila['odFechaPedido']} {$fila['odHoraPedido']}";
            $json['HoraFechaEntrega']="{$fila['odFechaEntrega']} {$fila['odHoraEntrega']}";
            $json['Nombre']="{$fila['perApellidos']} {$fila['perNombres']}";
            $json['mCobrar']= $fila['odGananciaTienda']+$fila['odGananciaRepartidor'];
            $json['Latitud']= $fila['odLatitudEntrega'];
            $json['Longitud']= $fila['odLongitudEntrega'];
            $json['TiempoEntrega']= $fila['odTiempoEntrega'];
            $json['TipoPago']= "EFECTIVO";
            $productos['Descripcion']=$fila['proDescripcion'];
            $productos['Cantidad']=$fila['doCantidad'];
            $productos['SubTotal']=$fila['doSubTotal'];
            $json['Producto'][]= $productos;
        }
        mysqli_close($conexion);
        echo json_encode($json);
    }else{
        die("Fallo la conexion");
    }
?>