<?php
include 'conexion.php';
$c_id_DocumentoPersona=$_GET['id_DocumentoPersona'];
$c_rep_Estado=$_GET['rep_Estado'];

$consulta="CALL sp_m_estadorepartidor('".$c_id_DocumentoPersona."', '".$c_rep_Estado."') ";

mysqli_query($conexion,$consulta) or die (mysqli_error($conexion));
mysqli_close($conexion);  

?>