<?php
include 'conexion.php';
$conexion->set_charset('utf8');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['p_tieNombre'], $_POST['p_tieImagen'], $_POST['p_tieURLWeb'], $_POST['p_tieDescripcion'], $_POST['p_tieCorreo'], $_POST['p_tieTelefono'], $_POST['p_tieDireccion'], $_POST['p_tieCiudad'], $_POST['p_tieEstado'], $_POST['p_tieVentasMensuales'], $_POST['p_tieInventarioEstimado'], $_POST['p_idDocumentoPersona'], $_POST['p_idRubroTienda'], $_POST['p_tieLatitud'], $_POST['p_tieLongitud'])) {
        
        $p_tienombre = $_POST['p_tieNombre'];
        $p_tieimagen = $_POST['p_tieImagen'];
        $p_tieURLWeb = $_POST['p_tieURLWeb'];
        $p_tieDescripcion = $_POST['p_tieDescripcion'];
        $p_tieCorreo = $_POST['p_tieCorreo'];
        $p_tieTelefono = $_POST['p_tieTelefono'];
        $p_tieDireccion = $_POST['p_tieDireccion'];
        $p_tieCiudad = $_POST['p_tieCiudad'];
        $p_tieEstado = $_POST['p_tieEstado'];
        $p_tieVentasMensuales = $_POST['p_tieVentasMensuales'];
        $p_tieInventarioEstimado = $_POST['p_tieInventarioEstimado'];
        $p_idDocumentoPersona = $_POST['p_idDocumentoPersona'];
        $p_idRubroTienda = $_POST['p_idRubroTienda'];
        $p_tieLatitud = $_POST['p_tieLatitud'];
        $p_tieLongitud = $_POST['p_tieLongitud'];

        if (empty($p_tieimagen)) {
            $imagePath = "";
        } else {
            $filePath = uniqid($p_idDocumentoPersona);
            $imagePath = "imgPerfilTienda/$filePath.jpeg";
            file_put_contents($imagePath, base64_decode($p_tieimagen));
        }

        if ($stmt = $conexion->prepare("CALL sp_a_datos_tienda_registrotienda(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")) {
            $stmt->bind_param('ssssssssssdsdds', $p_tienombre, $imagePath, $p_tieURLWeb, $p_tieDescripcion, $p_tieCorreo, $p_tieTelefono, $p_tieDireccion, $p_tieCiudad, $p_tieEstado, $p_tieVentasMensuales, $p_tieInventarioEstimado, $p_idDocumentoPersona, $p_idRubroTienda, $p_tieLatitud, $p_tieLongitud);
            
            if ($stmt->execute()) {
                echo json_encode(['success' => 'Registro exitoso de datos tienda.']);
            } else {
                echo json_encode(['error' => 'Error en la ejecución de la consulta: ' . $stmt->error]);
            }
            $stmt->close();
        } else {
            echo json_encode(['error' => 'Error al preparar la consulta: ' . $conexion->error]);
        }
    } else {
        echo json_encode(['error' => 'Faltan parámetros requeridos.']);
    }
} else {
    echo json_encode(['error' => 'Método no permitido. Se requiere una solicitud POST.']);
}
$conexion->close();
?>

