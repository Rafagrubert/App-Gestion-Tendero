<?php
include 'conexion.php';
$conexion->set_charset('utf8');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['idTienda'])) {
        $p_idTienda = $_GET['idTienda'];
        
        if ($stmt = $conexion->prepare("CALL sp_c_consultar_lista_producto(?)")) {
            $stmt->bind_param('s', $p_idTienda);
            
            if ($stmt->execute()) {
                $resultado = $stmt->get_result();
                $json = array('consulta' => array());
                
                while ($registro = $resultado->fetch_assoc()) {
                    $result = array(
                        'proDescripcion' => $registro['proDescripcion'],
                        'lptStock' => $registro['lptStock']
                    );
                    $json['consulta'][] = $result;
                }
                
                if (empty($json['consulta'])) {
                    $json = array('consulta' => array(array(
                        'success' => 0,
                        'message' => 'No se encontraron productos para esta tienda'
                    )));
                }
                
                $resultado->close();
                echo json_encode($json);
            } else {
                $json = array('consulta' => array(array(
                    'success' => 0,
                    'message' => 'Error en la ejecución de la consulta: ' . $stmt->error
                )));
                echo json_encode($json);
            }
            $stmt->close();
        } else {
            $json = array('consulta' => array(array(
                'success' => 0,
                'message' => 'Error al preparar la consulta: ' . $conexion->error
            )));
            echo json_encode($json);
        }
    } else {
        $json = array('consulta' => array(array(
            'success' => 0,
            'message' => 'No se proporcionó el ID de tienda'
        )));
        echo json_encode($json);
    }
} else {
    $json = array('consulta' => array(array(
        'success' => 0,
        'message' => 'Método no permitido. Se requiere una solicitud GET.'
    )));
    echo json_encode($json);
}

$conexion->close();
?>