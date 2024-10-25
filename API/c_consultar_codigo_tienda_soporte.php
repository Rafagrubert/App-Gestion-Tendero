<?php
include 'conexion.php';
$conexion->set_charset('utf8');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET["idpersona"])) {
        $idpersona = $_GET["idpersona"];
        
        if ($stmt = $conexion->prepare("CALL sp_c_consultar_codigo_tienda_soporte(?)")) {
            $stmt->bind_param('s', $idpersona);
            
            if ($stmt->execute()) {
                $resultado = $stmt->get_result();
                $json = array('CodTienda' => array());
                
                if ($registro = $resultado->fetch_assoc()) {
                    $json['CodTienda'][] = $registro;
                } else {
                    $json['CodTienda'][] = array(
                        'idTienda' => 'no registra'
                    );
                }
                
                $resultado->close();
                echo json_encode($json);
            } else {
                $json = array('CodTienda' => array(array(
                    'success' => 0,
                    'message' => 'Error en la ejecución de la consulta: ' . $stmt->error
                )));
                echo json_encode($json);
            }
            $stmt->close();
        } else {
            $json = array('CodTienda' => array(array(
                'success' => 0,
                'message' => 'Error al preparar la consulta: ' . $conexion->error
            )));
            echo json_encode($json);
        }
    } else {
        $json = array('CodTienda' => array(array(
            'success' => 0,
            'message' => 'WS no retorna'
        )));
        echo json_encode($json);
    }
} else {
    $json = array('CodTienda' => array(array(
        'success' => 0,
        'message' => 'Método no permitido. Se requiere una solicitud GET.'
    )));
    echo json_encode($json);
}

$conexion->close();
?>