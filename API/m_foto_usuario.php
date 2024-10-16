<?php
include 'conexion.php';
$c_id_DocumentoPersona=$_GET['id_DocumentoPersona'];
$c_usu_Imagen=$_GET['usu_Imagen'];

$consulta="CALL sp_m_foto_usuario('".$c_id_DocumentoPersona."', '".$c_usu_Imagen."') ";

mysqli_query($conexion,$consulta) or die (mysqli_error($conexion));
mysqli_close($conexion);  

?>
