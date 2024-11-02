<?php

include 'conexion.php';
$conexion->set_charset('utf8');

$json = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        isset($_POST["sp_usuCorreo"]) &&
        isset($_POST["sp_usuImagen"]) &&
        isset($_POST["sp_idRolUsuario"]) &&
        isset($_POST["sp_idDocumentoPersona"]) &&
        isset($_POST["sp_perNombres"]) &&
        isset($_POST["sp_perApellidos"]) &&
        isset($_POST["sp_perTipo"]) &&
        isset($_POST["sp_perNumeroCelular"]) &&
        isset($_POST["sp_perUbiLatitud"]) &&
        isset($_POST["sp_perUbiLongitud"])
    ) {
        $sp_usuCorreo = $_POST["sp_usuCorreo"];
        $sp_usuImagen = $_POST["sp_usuImagen"];
        $sp_idRolUsuario = $_POST["sp_idRolUsuario"];
        $sp_idDocumentoPersona = $_POST["sp_idDocumentoPersona"];
        $sp_perNombres = $_POST["sp_perNombres"];
        $sp_perApellidos = $_POST["sp_perApellidos"];
        $sp_perTipo = $_POST["sp_perTipo"];
        $sp_perNumeroCelular = $_POST["sp_perNumeroCelular"];
        $sp_perUbiLatitud = $_POST["sp_perUbiLatitud"];
        $sp_perUbiLongitud = $_POST["sp_perUbiLongitud"];

        // Verificación de existencia de ruta imagen
        if (empty($sp_usuImagen)) {
            $imagePath = "";
        } else {
            // Generación de código único
            $filePath = uniqid($sp_idDocumentoPersona);
            // Construimos la ruta de la imagen
            $imagePath = "imgUsuarios/" . $filePath . ".jpg";
            // Insertando imagen en el directorio del servidor
            file_put_contents($imagePath, base64_decode($sp_usuImagen));
        }

        if ($stmt = $conexion->prepare("CALL sp_a_registro_usuario_inicio_sesion(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")) {
            $stmt->bind_param('ssisssssss', $sp_usuCorreo, $imagePath, $sp_idRolUsuario, $sp_idDocumentoPersona, $sp_perNombres, $sp_perApellidos, $sp_perTipo, $sp_perNumeroCelular, $sp_perUbiLatitud, $sp_perUbiLongitud);

            if ($stmt->execute()) {
                $resultado = $stmt->get_result();
                while ($registro = $resultado->fetch_assoc()) {
                    $result = array(
                        "idUsuario" => $registro['idUsuario'],
                        "idRolUsuario" => $registro['idRolUsuario']
                    );
                    $json['datos_usuario'][] = $result;
                }
                echo json_encode($json);
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
    echo json_encode(['error' => 'Método no permitido. Se requiere una solicitud POST.']);
}

$conexion->close();
?>
