<?php
include 'conexion.php';
$conexion->set_charset('utf8');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['idOrden'])) {
        $idOrden = $_GET['idOrden'];

        if ($stmt = $conexion->prepare("CALL sp_c_coordenadas_entrega(?)")) {
            $stmt->bind_param('s', $idOrden);

            if ($stmt->execute()) {
                $resultado = $stmt->get_result();
                $json = array();

                if ($fila = $resultado->fetch_assoc()) {
                    $json['Latitud'] = $fila['odLatitudEntrega'];
                    $json['Longitud'] = $fila['odLongitudEntrega'];
                    $json['Nombre'] = "{$fila['perApellidos']} {$fila['perNombres']}";
                    $json['HoraFecha'] = "{$fila['odFechaPedido']} {$fila['odHoraPedido']}";
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
