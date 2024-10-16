<?php
include 'conexion.php';
$c_id_DocumentoPersona=$_GET['id_DocumentoPersona'];
$c_rep_Placa=$_GET['rep_Placa'];

$consulta="CALL sp_m_placa_repartidor('".$c_id_DocumentoPersona."', '".$c_rep_Placa."') ";

mysqli_query($conexion,$consulta) or die (mysqli_error($conexion));
mysqli_close($conexion);  

?>