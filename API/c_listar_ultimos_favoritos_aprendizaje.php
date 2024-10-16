<?php

include 'conexion.php';
$c_id_DocumentoPersona=$_GET['id_DocumentoPersona'];

$json = array();
        

        $consulta="CALL sp_c_listar_ultimos_favoritos_aprendizaje('{$c_id_DocumentoPersona}')"; 
        $resultado = mysqli_query($conexion,$consulta);

        while($registro = mysqli_fetch_array($resultado)){
        $result["perapEstado"]=$registro['perapEstado'];
        $result["perapFechaInscripcion"]=$registro['perapFechaInscripcion'];
        $result["idAprendizaje"]=$registro['idAprendizaje'];
        $result["idDocumentoPersona"]=$registro['idDocumentoPersona'];
        $result["apreTituloRecurso"]=$registro['apreTituloRecurso'];
        $result["apreContenido"]=$registro['apreContenido'];
        $json['consulta'][]=$result;   
        
        }

        mysqli_close($conexion);
        echo json_encode($json);
        

?>