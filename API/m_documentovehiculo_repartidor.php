<?php
include 'conexion.php';

if($_SERVER['REQUEST_METHOD']=='POST'){
    $c_id_DocumentoPersona=$_POST['id_DocumentoPersona'];
    $c_rep_DocumentoVehiculo=$_POST['rep_DocumentoVehiculo'];
    $nombre = uniqid();
    $PATH="doc_vehi_rep/{$nombre}.jpg";
    
    $insert="CALL sp_m_documentovehiculo_repartidor('{$c_id_DocumentoPersona}','{$PATH}')";
    $resultado_insert=mysqli_query($conexion,$insert);
    if($resultado_insert){
        try{
            file_put_contents($PATH,base64_decode($c_rep_DocumentoVehiculo));
            echo 'Registro realizado';
        }catch(Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
    }
}
?>
