<?php
include 'conexion.php';

// Inicializar el array de respuesta
$json = array();

// Verificar que todos los parámetros requeridos estén presentes
if (
    isset($_POST['provNombre']) &&
    isset($_POST['provDireccion']) &&
    isset($_POST['provCiudad']) &&
    isset($_POST['provDistrito']) &&
    isset($_POST['provCorreo']) &&
    isset($_POST['provTelefono']) &&
    isset($_POST['provRFC'])
) {
    // Obtener los valores de los parámetros
    $p_provNombre = $_POST['provNombre'];
    $p_provDireccion = $_POST['provDireccion'];
    $p_provCiudad = $_POST['provCiudad'];
    $p_provDistrito = $_POST['provDistrito'];
    $p_provCorreo = $_POST['provCorreo'];
    $p_provTelefono = $_POST['provTelefono'];
    $p_provRFC = $_POST['provRFC'];

    // Usar prepared statements para evitar inyección SQL
    if ($stmt = $conexion->prepare("CALL sp_a_reg_proveedor_almacen(?, ?, ?, ?, ?, ?, ?)")) {
        $stmt->bind_param('sssssss', $p_provNombre, $p_provDireccion, $p_provCiudad, $p_provDistrito, $p_provCorreo, $p_provTelefono, $p_provRFC);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            $json['success'] = true;
            $json['message'] = "Proveedor insertado";
        } else {
            $json['success'] = false;
            $json['error'] = "Error en la inserción: " . $stmt->error;
        }

        // Cerrar el statement
        $stmt->close();
    } else {
        $json['success'] = false;
        $json['error'] = "Error al preparar la consulta: " . $conexion->error;
    }
} else {
    $json['success'] = false;
    $json['error'] = "Faltan parámetros requeridos.";
}

// Cerrar la conexión
mysqli_close($conexion);

// Devolver la respuesta en formato JSON
echo json_encode($json);
?>
