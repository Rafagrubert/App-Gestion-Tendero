<?php
include 'conexion.php';
$conexion->set_charset('utf8');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id_Aprendizaje']) && isset($_GET['id_DocumentoPersona'])) {
        $c_id_Aprendizaje = $_GET['id_Aprendizaje'];
        $c_id_DocumentoPersona = $_GET['id_DocumentoPersona'];

        if ($stmt = $conexion->prepare("CALL sp_a_favorito_aprendizaje(?, ?)")) {
            $stmt->bind_param('ss', $c_id_Aprendizaje, $c_id_DocumentoPersona);
            
            if ($stmt->execute()) {
                $stmt->store_result();
                if ($stmt->affected_rows > 0) {
                    echo json_encode(['success' => 'Favorito agregado correctamente.']);
                } else {
                    echo json_encode(['error' => 'No se pudo agregar el favorito o no hubo cambios.']);
                }
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