<?php
include 'conexion.php';
$c_id_DocumentoPersona=$_GET['id_DocumentoPersona'];
$c_rep_TipoVehiculo=$_GET['rep_TipoVehiculo'];
$c_rep_NombreVehiculo=$_GET['rep_NombreVehiculo'];

$consulta="CALL sp_m_vehiculo_repartidor('".$c_id_DocumentoPersona."', '".$c_rep_TipoVehiculo."', '".$c_rep_NombreVehiculo."') ";

mysqli_query($conexion,$consulta) or die (mysqli_error($conexion));
mysqli_close($conexion);  

?>