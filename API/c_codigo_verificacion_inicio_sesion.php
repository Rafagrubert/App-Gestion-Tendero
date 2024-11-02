<?php
include 'conexion.php';
$conexion->set_charset('utf8');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['sp_codvCorreo'])) {
        $sp_codvCorreo = $_GET['sp_codvCorreo'];

        if ($stmt = $conexion->prepare("CALL sp_c_codigo_verificacion_inicio_sesion(?)")) {
            $stmt->bind_param('s', $sp_codvCorreo);

            if ($stmt->execute()) {
                $resultado = $stmt->get_result();
                $json = array();

                while ($registro = $resultado->fetch_assoc()) {
                    $result = array(
                        "codvCorreo" => $registro['codvCorreo'],
                        "codvCodigo" => $registro['codvCodigo']
                    );
                    $json['usuario'][] = $result;
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
