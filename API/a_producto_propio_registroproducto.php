<?php
include 'conexion.php';

$json = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar que se reciban todos los parámetros
    if (
        isset($_POST['p_lptDescripcionProductoTienda']) &&
        isset($_POST['p_lptStock']) &&
        isset($_POST['p_lptUnidadMedida']) &&
        isset($_POST['p_lptStockMinimo']) &&
        isset($_POST['p_lptPrecioCompra']) &&
        isset($_POST['p_lptPrecioVenta']) &&
        isset($_POST['p_idTienda']) &&
        isset($_POST['p_lptImagen1']) &&
        isset($_POST['p_lptImagen2']) &&
        isset($_POST['p_lptImagen3'])
    ) {
        $p_lptDescripcionProductoTienda = $_POST['p_lptDescripcionProductoTienda'];
        $p_lptStock = $_POST['p_lptStock'];
        $p_lptUnidadMedida = $_POST['p_lptUnidadMedida'];
        $p_lptStockMinimo = $_POST['p_lptStockMinimo'];
        $p_lptImagen1 = $_POST['p_lptImagen1'];
        $p_lptImagen2 = $_POST['p_lptImagen2'];
        $p_lptImagen3 = $_POST['p_lptImagen3'];
        $p_lptPrecioCompra = $_POST['p_lptPrecioCompra'];
        $p_lptPrecioVenta = $_POST['p_lptPrecioVenta'];
        $p_idTienda = $_POST['p_idTienda'];

        // Función para guardar imagen
        function saveImage($imageData, $idTienda) {
            if (empty($imageData)) {
                return "";
            } else {
                $filePath = uniqid($idTienda);
                $imagePath = "imgProductosTienda/" . $filePath . ".jpeg";
                file_put_contents($imagePath, base64_decode($imageData));
                return $imagePath;
            }
        }

        // Guardar imágenes
        $imagePath1 = saveImage($p_lptImagen1, $p_idTienda);
        $imagePath2 = saveImage($p_lptImagen2, $p_idTienda);
        $imagePath3 = saveImage($p_lptImagen3, $p_idTienda);

        // Usar prepared statement para la inserción
        if ($stmt = $conexion->prepare("CALL sp_a_producto_propio_registroproducto(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")) {
            $stmt->bind_param('siissssdds', $p_lptDescripcionProductoTienda, $p_lptStock, $p_lptUnidadMedida, $p_lptStockMinimo, $imagePath1, $imagePath2, $imagePath3, $p_lptPrecioCompra, $p_lptPrecioVenta, $p_idTienda);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                $json['success'] = true;
                $json['message'] = 'Registro exitoso de Producto';
            } else {
                $json['success'] = false;
                $json['message'] = 'Fallo en Registrar Producto: ' . $stmt->error;
            }

            // Cerrar el statement
            $stmt->close();
        } else {
            $json['success'] = false;
            $json['message'] = 'Error al preparar la consulta: ' . $conexion->error;
        }
    } else {
        $json['success'] = false;
        $json['message'] = 'Faltan parámetros requeridos.';
    }

    // Cerrar la conexión
    mysqli_close($conexion);

    // Devolver la respuesta en formato JSON
    echo json_encode($json);
}
?>
