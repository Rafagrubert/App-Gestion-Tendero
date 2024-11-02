<?php
include 'conexion.php';
$conexion->set_charset('utf8');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id_Orden'])) {
        $c_id_orden = $_GET['id_Orden'];

        if ($stmt = $conexion->prepare("CALL sp_c_consultar_mensajes_chat_x_orden(?)")) {
            $stmt->bind_param('i', $c_id_orden);

            if ($stmt->execute()) {
                $resultado = $stmt->get_result();
                $json = array();

                while ($registro = $resultado->fetch_assoc()) {
                    $result = array(
                        "idChat" => $registro['idChat'],
                        "idUsuario" => $registro['idUsuario'],
                        "ruNombre" => $registro['ruNombre'],
                        "perNombres" => $registro['perNombres'],
                        "usuImagen" => $registro['usuImagen'],
                        "menFechaEnvio" => $registro['menFechaEnvio'],
                        "menContenido" => $registro['menContenido'],
                        "menImagen" => $registro['menImagen']
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
