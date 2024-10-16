<?php
include 'conexion.php';
$c_id_DocumentoPersona=$_GET['id_DocumentoPersona'];
$c_rep_LicenciaEstado=$_GET['rep_LicenciaEstado'];

$consulta="CALL sp_m_estadolicencia_repartidor('".$c_id_DocumentoPersona."', '".$c_rep_LicenciaEstado."') ";

mysqli_query($conexion,$consulta) or die (mysqli_error($conexion));
mysqli_close($conexion);  

?>