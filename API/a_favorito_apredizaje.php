<?php
include 'conexion.php';

// Inicializar el array para la respuesta
$response = array();

// Verificar que la solicitud sea un POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar que se reciban todos los parámetros necesarios
    if (
        isset($_POST['id_Aprendizaje']) &&
        isset($_POST['id_DocumentoPersona'])
    ) {
        // Asignación de variables
        $c_id_Aprendizaje = intval($_POST['id_Aprendizaje']);
        $c_id_DocumentoPersona = intval($_POST['id_DocumentoPersona']);

        // Preparar la consulta
        if ($stmt = $conexion->prepare("CALL sp_a_favorito_aprendizaje(?, ?)")) {
            $stmt->bind_param('ii', $c_id_Aprendizaje, $c_id_DocumentoPersona);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                $response['success'] = true;
                $response['message'] = 'Aprendizaje agregado a favoritos exitosamente.';
            } else {
                $response['success'] = false;
                $response['message'] = 'Fallo al agregar a favoritos: ' . $stmt->error;
            }

            // Cerrar el statement
            $stmt->close();
        } else {
            $response['success'] = false;
            $response['message'] = 'Error al preparar la consulta: ' . $conexion->error;
        }
    } else {
        $response['success'] = false;
        $response['message'] = 'Faltan parámetros requeridos.';
    }

    // Cerrar la conexión
    mysqli_close($conexion);

    // Devolver la respuesta en formato JSON
    echo json_encode($response);
}
?>
