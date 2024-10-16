<?php
include 'conexion.php';

if($_SERVER['REQUEST_METHOD']=='POST'){
    $id_DocumentoPersona=$_POST['id_DocumentoPersona'];
    $usu_Imagen=$_POST['usu_Imagen'];
    $nombre = uniqid($id_DocumentoPersona);
    $PATH="imgUsuarios/{$nombre}.jpg";
    $insert="CALL sp_m_foto_usuario('{$id_DocumentoPersona}','{$PATH}')";
    $resultado_insert=mysqli_query($conexion,$insert);
    if($resultado_insert){
        try{
            file_put_contents($PATH,base64_decode($usu_Imagen));
            echo 'Registro realizado';
        }catch(Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
    }
}
?>