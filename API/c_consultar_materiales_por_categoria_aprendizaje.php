<?php
include 'conexion.php';
$conexion->set_charset('utf8');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['categoria'], $_GET['idpersona'])) {
        $c_categoria_apre = $_GET['categoria'];
        $c_id_persona = $_GET['idpersona'];

        if ($stmt = $conexion->prepare("CALL sp_c_consultar_materiales_por_categoria_aprendizaje(?, ?)")) {
            $stmt->bind_param('si', $c_categoria_apre, $c_id_persona);

            if ($stmt->execute()) {
                $resultado = $stmt->get_result();
                $json = array();

                while ($registro = $resultado->fetch_assoc()) {
                    $result = array(
                        "idAprendizaje" => $registro['idAprendizaje'],
                        "apreTituloRecurso" => $registro['apreTituloRecurso'],
                        "apreContenido" => $registro['apreContenido'],
                        "apreperLike" => $registro['apreperLike']
                    );
                    $json['matCategoria'][] = $result;
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
