<?php
include 'conexion.php';

if($_SERVER['REQUEST_METHOD']=='POST'){
    $c_id_DocumentoPersona=$_POST['id_DocumentoPersona'];
    $c_rep_Antecedentes=$_POST['rep_Antecedentes'];
    $nombre = uniqid();
    $PATH="doc_rep/{$nombre}.jpg";
    
    $insert="CALL sp_m_antecedente_repartidor('{$c_id_DocumentoPersona}','{$PATH}')";
    $resultado_insert=mysqli_query($conexion,$insert);
    if($resultado_insert){
        try{
            file_put_contents($PATH,base64_decode($c_rep_Antecedentes));
            echo 'Registro realizado';
        }catch(Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
    }
}
?>
