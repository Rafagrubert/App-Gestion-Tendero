<?php
include 'conexion.php';
$c_id_DocumentoPersona=$_GET['id_DocumentoPersona'];
$c_per_NumeroCelular=$_GET['per_NumeroCelular'];

$consulta="CALL sp_m_numerocelular_persona('".$c_id_DocumentoPersona."', '".$c_per_NumeroCelular."') ";

mysqli_query($conexion,$consulta) or die (mysqli_error($conexion));
mysqli_close($conexion);  

?>