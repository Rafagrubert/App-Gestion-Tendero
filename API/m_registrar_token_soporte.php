<?php
include 'conexion.php';

if(isset($_POST['sp_Doc_persona'])&&isset($_POST['sp_Token_personal'])){

    $sp_Doc_persona=$_POST['sp_Doc_persona'];
$sp_Token_personal=$_POST['sp_Token_personal'];

$consulta="CALL sp_m_actualizar_token_soporte(".$sp_Doc_persona.",'".$sp_Token_personal."')";
mysqli_query($conexion,$consulta) or die (mysqli_error($conexion));
}
mysqli_close($conexion);
        
?>
