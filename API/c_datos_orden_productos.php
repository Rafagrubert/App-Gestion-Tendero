<?php
include 'conexion.php';
$conexion->set_charset('utf8');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['idOrden'])) {
        $idOrden = $_GET['idOrden'];

        if ($stmt = $conexion->prepare("CALL sp_c_datos_y_productos_orden(?)")) {
            $stmt->bind_param('s', $idOrden);

            if ($stmt->execute()) {
                $resultado = $stmt->get_result();
                $json = array();

                while ($fila = $resultado->fetch_assoc()) {
                    $json['idOrden'] = $fila['idOrden'];
                    $json['HoraFechaInicial'] = "{$fila['odFechaPedido']} {$fila['odHoraPedido']}";
                    $json['HoraFechaEntrega'] = "{$fila['odFechaEntrega']} {$fila['odHoraEntrega']}";
                    $json['Nombre'] = "{$fila['perApellidos']} {$fila['perNombres']}";
                    $json['mCobrar'] = $fila['odGananciaTienda'] + $fila['odGananciaRepartidor'];
                    $json['Latitud'] = $fila['odLatitudEntrega'];
                    $json['Longitud'] = $fila['odLongitudEntrega'];
                    $json['TiempoEntrega'] = $fila['odTiempoEntrega'];
                    $json['TipoPago'] = "EFECTIVO";

                    $producto = array(
                        'Descripcion' => $fila['proDescripcion'],
                        'Cantidad' => $fila['doCantidad'],
                        'SubTotal' => $fila['doSubTotal']
                    );
                    $json['Producto'][] = $producto;
                }

                echo json_encode($json);
            } else {
                echo json_encode(['error' => 'Error en la ejecución de la consulta: ' . $stmt->error]);
            }
            $stmt->close();
        } else {
            echo json_encode(['error' => 'Error al preparar la consulta: ' . $conexion->error]);
        }
    } else {
        echo json_encode(['error' => 'No se proporcionaron todos los parámetros requeridos.']);
    }
} else {
    echo json_encode(['error' => 'Método no permitido. Se requiere una solicitud GET.']);
}

$conexion->close();
?>
