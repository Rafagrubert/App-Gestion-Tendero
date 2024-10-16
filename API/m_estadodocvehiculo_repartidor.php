<?php
include 'conexion.php';
$c_id_DocumentoPersona=$_GET['id_DocumentoPersona'];
$c_rep_DocumentoVehiculoEstado=$_GET['rep_DocumentoVehiculoEstado'];

$consulta="CALL sp_m_estadodocvehiculo_repartidor('".$c_id_DocumentoPersona."', '".$c_rep_DocumentoVehiculoEstado."') ";

mysqli_query($conexion,$consulta) or die (mysqli_error($conexion));
mysqli_close($conexion);  

?>