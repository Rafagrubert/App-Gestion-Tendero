<?php
include 'conexion.php';

if($_SERVER['REQUEST_METHOD']=='POST'){
    $c_id_DocumentoPersona=$_POST['id_DocumentoPersona'];
    $c_rep_Licencia=$_POST['rep_Licencia'];
    $nombre = uniqid();
    $PATH="doc_rep/{$nombre}.jpg";
    
    $insert="CALL sp_m_licencia_repartidor('{$c_id_DocumentoPersona}','{$PATH}')";
    $resultado_insert=mysqli_query($conexion,$insert);
    if($resultado_insert){
        try{
            file_put_contents($PATH,base64_decode($c_rep_Licencia));
            echo 'Registro realizado';
        }catch(Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
    }
}
?>
