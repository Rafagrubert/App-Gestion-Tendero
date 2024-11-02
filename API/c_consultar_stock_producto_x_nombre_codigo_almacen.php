<?php
include 'conexion.php';
$conexion->set_charset('utf8');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['idTienda'], $_GET['idProducto'], $_GET['proDescripcion'], $_GET['xp_modbusc'])) {
        $p_idTienda = $_GET['idTienda'];
        $p_idProducto = (int) $_GET['idProducto'];
        $p_proDescripcion = $_GET['proDescripcion'];
        $xp_modbusc = $_GET['xp_modbusc'];

        if ($stmt = $conexion->prepare("CALL sp_c_consultar_stock_producto_x_nombre_codigo_almacen(?, ?, ?, ?)")) {
            $stmt->bind_param('iisi', $p_idTienda, $p_idProducto, $p_proDescripcion, $xp_modbusc);

            if ($stmt->execute()) {
                $resultado = $stmt->get_result();
                $json = array();

                while ($registro = $resultado->fetch_assoc()) {
                    $result = array(
                        "idTienda" => $registro['idTienda'],
                        "idProducto" => $registro['idProducto'],
                        "proDescripcion" => $registro['proDescripcion'],
                        "lptStock" => $registro['lptStock'],
                        "idListadoProductoTienda" => $registro['idListadoProductoTienda']
                    );
                    $json['consulta'][] = $result;
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
