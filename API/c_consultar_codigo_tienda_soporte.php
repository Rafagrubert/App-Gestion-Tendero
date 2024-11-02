<?php
include 'conexion.php';
$conexion->set_charset('utf8');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['idpersona'])) {
        $idpersona = $_GET['idpersona'];

        if ($stmt = $conexion->prepare("CALL sp_c_consultar_codigo_tienda_soporte(?)")) {
            $stmt->bind_param('s', $idpersona);

            if ($stmt->execute()) {
                $resultado = $stmt->get_result();
                $json = array();

                if ($registro = $resultado->fetch_assoc()) {
                    $json['CodTienda'][] = $registro;
                } else {
                    $resultar = array("idTienda" => 'no registra');
                    $json['CodTienda'][] = $resultar;
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
        $resultar = array("success" => 0, "message" => 'WS no retorna');
        $json['CodTienda'][] = $resultar;
        echo json_encode($json);
    }
} else {
    echo json_encode(['error' => 'Método no permitido. Se requiere una solicitud GET.']);
}

$conexion->close();
?>
