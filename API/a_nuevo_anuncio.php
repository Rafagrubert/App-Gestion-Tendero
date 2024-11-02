<?php
include 'conexion.php';

// Inicializar el array para la respuesta
$response = array();

// Verificar que la solicitud sea un POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar que se reciban todos los parámetros necesarios
    if (
        isset($_POST['pathImg']) &&
        isset($_POST['titulo']) &&
        isset($_POST['descripcion']) &&
        isset($_POST['linkRed']) &&
        isset($_POST['fechaInicio']) &&
        isset($_POST['fechaFin']) &&
        isset($_POST['idTienda']) &&
        isset($_POST['montoPubli']) &&
        isset($_POST['fechaPago'])
    ) {
        // Asignación de variables
        $c_imagen = $_POST['pathImg'];
        $c_titulo = $_POST['titulo'];
        $c_descripcion = $_POST['descripcion'];
        $c_linkRedi = $_POST['linkRed'];
        $c_fechaI = $_POST['fechaInicio'];
        $c_fechaF = $_POST['fechaFin'];
        $c_id_tienda = $_POST['idTienda'];
        $c_monto = $_POST['montoPubli'];
        $c_fechaP = $_POST['fechaPago'];

        // Verificación y creación de la ruta de la imagen
        $imagePath = "";
        if (!empty($c_imagen)) {
            // Generación de un código único
            $filePath = uniqid($c_id_tienda);
            // Construimos la ruta de la imagen
            $imagePath = "imgPublicaciones/$filePath.jpg";
            // Insertamos la imagen en el directorio del servidor
            if (file_put_contents($imagePath, base64_decode($c_imagen)) === false) {
                $response['success'] = false;
                $response['message'] = 'Error al guardar la imagen.';
                echo json_encode($response);
                exit;
            }
        }

        // Preparar la consulta
        if ($stmt = $conexion->prepare("CALL sp_a_nuevo_anuncio(?, ?, ?, ?, ?, ?, ?, ?, ?)")) {
            $stmt->bind_param('sssssisss', $imagePath, $c_titulo, $c_descripcion, $c_linkRedi, $c_fechaI, $c_fechaF, $c_id_tienda, $c_monto, $c_fechaP);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                $response['success'] = true;
                $response['message'] = 'Anuncio creado exitosamente.';
            } else {
                $response['success'] = false;
                $response['message'] = 'Fallo al crear el anuncio: ' . $stmt->error;
            }

            // Cerrar el statement
            $stmt->close();
        } else {
            $response['success'] = false;
            $response['message'] = 'Error al preparar la consulta: ' . $conexion->error;
        }
    } else {
        $response['success'] = false;
        $response['message'] = 'Faltan parámetros requeridos.';
    }

    // Cerrar la conexión
    mysqli_close($conexion);

    // Devolver la respuesta en formato JSON
    echo json_encode($response);
}
?>
