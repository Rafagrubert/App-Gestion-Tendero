<?php
include 'conexion.php';

// Inicializar el array para la respuesta
$response = array();

// Verificar que la solicitud sea un POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar que se reciban todos los parámetros necesarios
    $requiredFields = [
        'p_tieNombre', 'p_tieImagen', 'p_tieURLWeb', 'p_tieDescripcion',
        'p_tieCorreo', 'p_tieTelefono', 'p_tieDireccion', 'p_tieCiudad',
        'p_tieEstado', 'p_tieVentasMensuales', 'p_tieInventarioEstimado',
        'p_idDocumentoPersona', 'p_idRubroTienda', 'p_tieLatitud', 'p_tieLongitud'
    ];
    
    foreach ($requiredFields as $field) {
        if (!isset($_POST[$field])) {
            $response['success'] = false;
            $response['message'] = 'Faltan parámetros requeridos: ' . $field;
            echo json_encode($response);
            exit;
        }
    }

    // Asignación de variables y validación
    $p_tienombre = $_POST['p_tieNombre'];
    $p_tieimagen = $_POST['p_tieImagen'];
    $p_tieURLWeb = $_POST['p_tieURLWeb'];
    $p_tieDescripcion = $_POST['p_tieDescripcion'];
    $p_tieCorreo = $_POST['p_tieCorreo'];
    $p_tieTelefono = $_POST['p_tieTelefono'];
    $p_tieDireccion = $_POST['p_tieDireccion'];
    $p_tieCiudad = $_POST['p_tieCiudad'];
    $p_tieEstado = $_POST['p_tieEstado'];
    $p_tieVentasMensuales = floatval($_POST['p_tieVentasMensuales']);
    $p_tieInventarioEstimado = floatval($_POST['p_tieInventarioEstimado']);
    $p_idDocumentoPersona = intval($_POST['p_idDocumentoPersona']);
    $p_idRubroTienda = intval($_POST['p_idRubroTienda']);
    $p_tieLatitud = floatval($_POST['p_tieLatitud']);
    $p_tieLongitud = floatval($_POST['p_tieLongitud']);

    // Verificación de existencia de ruta imagen
    if (empty($p_tieimagen)) {
        $imagePath = "";
    } else {
        // Generación de código único
        $filePath = uniqid($p_idDocumentoPersona);
        // Construimos la ruta de la imagen
        $imagePath = "imgPerfilTienda/" . $filePath . ".jpeg";
        // Insertando imagen en el directorio del servidor
        if (!file_put_contents($imagePath, base64_decode($p_tieimagen))) {
            $response['success'] = false;
            $response['message'] = 'Error al guardar la imagen en el servidor.';
            echo json_encode($response);
            exit;
        }
    }

    // Preparar y ejecutar la consulta
    if ($stmt = $conexion->prepare("CALL sp_a_datos_tienda_registrotienda(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")) {
        $stmt->bind_param('sssssisssddiidd', $p_tienombre, $imagePath, $p_tieURLWeb, $p_tieDescripcion,
            $p_tieCorreo, $p_tieTelefono, $p_tieDireccion, $p_tieCiudad, $p_tieEstado, 
            $p_tieVentasMensuales, $p_tieInventarioEstimado, $p_idDocumentoPersona, 
            $p_idRubroTienda, $p_tieLatitud, $p_tieLongitud);

        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = 'Registro exitoso de datos tienda';
        } else {
            $response['success'] = false;
            $response['message'] = 'Fallo en Registrar Datos tienda: ' . $stmt->error;
        }

        // Cerrar el statement
        $stmt->close();
    } else {
        $response['success'] = false;
        $response['message'] = 'Error al preparar la consulta: ' . $conexion->error;
    }

    // Cerrar la conexión
    mysqli_close($conexion);

    // Devolver la respuesta en formato JSON
    echo json_encode($response);
}
?>
