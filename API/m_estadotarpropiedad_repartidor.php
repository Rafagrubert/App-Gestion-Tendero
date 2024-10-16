<?php
include 'conexion.php';
$c_id_DocumentoPersona=$_GET['id_DocumentoPersona'];
$c_rep_TarjetaPropiedadEstado=$_GET['rep_TarjetaPropiedadEstado'];

$consulta="CALL sp_m_estadotarpropiedad_repartidor('".$c_id_DocumentoPersona."', '".$c_rep_TarjetaPropiedadEstado."') ";

mysqli_query($conexion,$consulta) or die (mysqli_error($conexion));
mysqli_close($conexion);  

?>