<?php
include 'conexion.php';
$conexion->set_charset('utf8');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['sp_idDocumentoPersona'])) {
        $sp_idDocumentoPersona = $_GET['sp_idDocumentoPersona'];

        if ($stmt = $conexion->prepare("CALL sp_c_existencia_persona_inicio_sesion(?)")) {
            $stmt->bind_param('s', $sp_idDocumentoPersona);

            if ($stmt->execute()) {
                $resultado = $stmt->get_result();
                $json = array();

                while ($registro = $resultado->fetch_assoc()) {
                    $result = array(
                        "idDocumentoPersona" => $registro['idDocumentoPersona']
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

