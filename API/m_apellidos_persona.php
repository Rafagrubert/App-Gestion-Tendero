<?php
include 'conexion.php';
$c_id_DocumentoPersona=$_GET['id_DocumentoPersona'];
$c_per_Apellidos=$_GET['per_Apellidos'];

$consulta="CALL sp_m_apellidos_Persona('".$c_id_DocumentoPersona."', '".$c_per_Apellidos."') ";

mysqli_query($conexion,$consulta) or die (mysqli_error($conexion));
mysqli_close($conexion);  
?>