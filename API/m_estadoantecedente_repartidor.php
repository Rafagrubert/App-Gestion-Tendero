<?php
include 'conexion.php';
$c_id_DocumentoPersona=$_GET['id_DocumentoPersona'];
$c_rep_AntecedentesEstado=$_GET['rep_AntecedentesEstado'];

$consulta="CALL sp_m_estadoantecedente_repartidor('".$c_id_DocumentoPersona."', '".$c_rep_AntecedentesEstado."') ";

mysqli_query($conexion,$consulta) or die (mysqli_error($conexion));
mysqli_close($conexion);  

?>