<?php
include 'conexion.php';
$c_id_DocumentoPersona=$_GET['id_DocumentoPersona'];
$c_per_Nombres=$_GET['per_Nombres'];

$consulta="CALL sp_m_nombre_persona('".$c_id_DocumentoPersona."', '".$c_per_Nombres."') ";

mysqli_query($conexion,$consulta) or die (mysqli_error($conexion));
mysqli_close($conexion);  
?>