<?php
include 'conexion.php';
$c_id_DocumentoPersona=$_GET['id_DocumentoPersona'];
$c_per_UbiLatitud=$_GET['per_UbiLatitud'];
$c_per_UbiLongitud=$_GET['per_UbiLongitud'];

$consulta="CALL sp_m_direccion_persona('".$c_id_DocumentoPersona."', '".$c_per_UbiLatitud."', '".$c_per_UbiLongitud."') ";

mysqli_query($conexion,$consulta) or die (mysqli_error($conexion));
mysqli_close($conexion);           


?>