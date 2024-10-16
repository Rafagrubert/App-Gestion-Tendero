<?php

include 'conexion.php';
$c_id_Aprendizaje=$_GET['id_Aprendizaje'];
$c_id_DocumentoPersona=$_GET['id_DocumentoPersona'];

$json = array();
        $consulta="CALL sp_m_estado_favorito_aprendizaje({$c_id_Aprendizaje},{$c_id_DocumentoPersona})";
        $resultado = mysqli_query($conexion,$consulta);
        while($registro = mysqli_fetch_array($resultado)){
        $result["perapEstado"]=$registro['perapEstado'];
        $result["perapFechaInscripcion"]=$registro['perapFechaInscripcion'];
        $result["idAprendizaje"]=$registro['idAprendizaje'];
        $result["idDocumentoPersona"]=$registro['idDocumentoPersona'];

        $json['update_favoritos'][]=$result;   
        
        }

        mysqli_close($conexion);
        echo json_encode($json);
?>