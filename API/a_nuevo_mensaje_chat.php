<?php
include 'conexion.php';

$json = array();

// Verificar que la solicitud sea un POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar que se reciban todos los parámetros necesarios
    if (
        isset($_POST['id_Orden']) &&
        isset($_POST['id_usuario']) &&
        isset($_POST['mensaje']) &&
        isset($_POST['imagen'])
    ) {
        // Asignación de variables
        $c_id_orden = $_POST['id_Orden'];
        $c_id_usuario = $_POST['id_usuario'];
        $c_mensaje = $_POST['mensaje'];
        $c_imagen = $_POST['imagen'];

        // Usar prepared statements para la inserción
        if ($stmt = $conexion->prepare("CALL sp_a_nuevo_mensaje_chat(?, ?, ?, ?)")) {
            $stmt->bind_param('iiss', $c_id_orden, $c_id_usuario, $c_mensaje, $c_imagen);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                $json['success'] = true;
                $json['message'] = 'Mensaje enviado exitosamente.';
            } else {
                $json['success'] = false;
                $json['message'] = 'Fallo al enviar el mensaje: ' . $stmt->error;
            }

            // Cerrar el statement
            $stmt->close();
        } else {
            $json['success'] = false;
            $json['message'] = 'Error al preparar la consulta: ' . $conexion->error;
        }
    } else {
        $json['success'] = false;
        $json['message'] = 'Faltan parámetros requeridos.';
    }

    // Cerrar la conexión
    mysqli_close($conexion);

    // Devolver la respuesta en formato JSON
    echo json_encode($json);
}
?>
