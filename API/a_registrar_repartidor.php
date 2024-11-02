<?php

include 'conexion.php';

$json = array();

if (isset($_GET["tipo"]) && isset($_GET["nombre"]) && isset($_GET["placa"]) && isset($_GET["documento"])) {
    $tipo = $_GET['tipo'];
    $nombre = $_GET['nombre'];
    $placa = $_GET['placa'];
    $documento = $_GET['documento'];

    // Usar prepared statements para evitar inyección SQL
    if ($stmt = $conexion->prepare("CALL sp_a_repartidor_reg(?, ?, ?, ?)")) {
        $stmt->bind_param('ssss', $tipo, $nombre, $placa, $documento);
        
        if ($stmt->execute()) {
            $resultado = $stmt->get_result();
            if ($fila = $resultado->fetch_assoc()) {
                $json['Nombre'] = "{$fila['perApellidos']} {$fila['perNombres']}";
                $json['Imagen'] = $fila['usuImagen'];
                $json['idRepartidor'] = $fila['idRepartidor'];
                $json['idUsuario'] = $fila['idUsuario'];
            } else {
                $json['error'] = 'No se encontraron resultados.';
            }
        } else {
            $json['error'] = 'Error en la ejecución de la consulta: ' . $stmt->error;
        }
        
        $stmt->close();
    } else {
        $json['error'] = 'Error al preparar la consulta: ' . $conexion->error;
    }

    mysqli_close($conexion);
    echo json_encode($json);
} else {
    echo json_encode(['error' => 'Faltan parámetros requeridos.']);
}

?>
