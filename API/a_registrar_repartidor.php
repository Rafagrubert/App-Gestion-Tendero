
<?php
include 'conexion.php';
$conexion->set_charset('utf8');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET["tipo"]) && 
        isset($_GET["nombre"]) && 
        isset($_GET["placa"]) && 
        isset($_GET["documento"])) {
        
        $tipo = $_GET['tipo'];
        $nombre = $_GET['nombre'];
        $placa = $_GET['placa'];
        $documento = $_GET['documento'];

        if ($stmt = $conexion->prepare("CALL sp_a_repartidor_reg(?, ?, ?, ?)")) {
            $stmt->bind_param('ssss', $tipo, $nombre, $placa, $documento);
            
            if ($stmt->execute()) {
                $resultado = $stmt->get_result();
                if ($fila = $resultado->fetch_assoc()) {
                    $json = [
                        'Nombre' => $fila['perApellidos'] . " " . $fila['perNombres'],
                        'Imagen' => $fila['usuImagen'],
                        'idRepartidor' => $fila['idRepartidor'],
                        'idUsuario' => $fila['idUsuario']
                    ];
                    echo json_encode($json);
                } else {
                    echo json_encode(['error' => 'No se encontraron datos del repartidor.']);
                }
                $resultado->close();
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