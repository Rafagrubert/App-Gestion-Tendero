<?php
include 'conexion.php';
$conexion->set_charset('utf8');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET["sp_idDocumentoPersona"])) {
        $sp_idDocumentoPersona = $_GET["sp_idDocumentoPersona"];
        
        if ($stmt = $conexion->prepare("CALL sp_c_existencia_persona_inicio_sesion(?)")) {
            $stmt->bind_param('s', $sp_idDocumentoPersona);
            
            if ($stmt->execute()) {
                $resultado = $stmt->get_result();
                $json = array('usuario' => array());
                
                while ($registro = $resultado->fetch_assoc()) {
                    $result = array(
                        'idDocumentoPersona' => $registro['idDocumentoPersona']
                    );
                    $json['usuario'][] = $result;
                }
                
                if (empty($json['usuario'])) {
                    $json = array('usuario' => array(array(
                        'success' => 0,
                        'message' => 'No se encontraron registros'
                    )));
                }
                
                $resultado->close();
                echo json_encode($json);
            } else {
                $json = array('usuario' => array(array(
                    'success' => 0,
                    'message' => 'Error en la ejecución de la consulta: ' . $stmt->error
                )));
                echo json_encode($json);
            }
            $stmt->close();
        } else {
            $json = array('usuario' => array(array(
                'success' => 0,
                'message' => 'Error al preparar la consulta: ' . $conexion->error
            )));
            echo json_encode($json);
        }
    } else {
        $json = array('usuario' => array(array(
            'success' => 0,
            'message' => 'No se proporcionó el ID de documento de persona'
        )));
        echo json_encode($json);
    }
} else {
    $json = array('usuario' => array(array(
        'success' => 0,
        'message' => 'Método no permitido. Se requiere una solicitud GET.'
    )));
    echo json_encode($json);
}

$conexion->close();
?>

