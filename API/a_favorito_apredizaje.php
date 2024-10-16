<?php

include 'conexion.php';
$c_id_Aprendizaje=$_GET['id_Aprendizaje'];
$c_id_DocumentoPersona=$_GET['id_DocumentoPersona'];

$json = array();
        $consulta="CALL sp_a_favorito_aprendizaje({$c_id_Aprendizaje},{$c_id_DocumentoPersona})";
        $resultado = mysqli_query($conexion,$consulta);

        mysqli_close($conexion);
?>