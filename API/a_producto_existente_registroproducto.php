<?php
include 'conexion.php';

$json = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar que se reciban todos los parámetros necesarios
    if (
        isset($_POST['p_lptDescripcionProductoTienda']) &&
        isset($_POST['p_lptStock']) &&
        isset($_POST['p_lptUnidadMedida']) &&
        isset($_POST['p_lptStockMinimo']) &&
        isset($_POST['p_lptImagen1']) &&
        isset($_POST['p_lptPrecioCompra']) &&
        isset($_POST['p_lptPrecioVenta']) &&
        isset($_POST['p_idProducto']) &&
        isset($_POST['p_idTienda'])
    ) {
        // Asignación de variables
        $p_lptDescripcionProductoTienda = $_POST['p_lptDescripcionProductoTienda'];
        $p_lptStock = $_POST['p_lptStock'];
        $p_lptUnidadMedida = $_POST['p_lptUnidadMedida'];
        $p_lptStockMinimo = $_POST['p_lptStockMinimo'];
        $p_lptImagen1 = $_POST['p_lptImagen1'];
        $p_lptPrecioCompra = $_POST['p_lptPrecioCompra'];
        $p_lptPrecioVenta = $_POST['p_lptPrecioVenta'];
        $p_idProducto = $_POST['p_idProducto'];
        $p_idTienda = $_POST['p_idTienda'];

        // Usar prepared statements para la inserción
        if ($stmt = $conexion->prepare("CALL sp_a_producto_existente_registroproducto(?, ?, ?, ?, ?, ?, ?, ?, ?)")) {
            $stmt->bind_param('siissdd', $p_lptDescripcionProductoTienda, $p_lptStock, $p_lptUnidadMedida, $p_lptStockMinimo, $p_lptImagen1, $p_lptPrecioCompra, $p_lptPrecioVenta, $p_idProducto, $p_idTienda);

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
