<?php
include 'conexion.php';
$c_id_DocumentoPersona=$_GET['id_DocumentoPersona'];

$json = array();
        $consulta="CALL sp_c_estado_repartidor('".$c_id_DocumentoPersona."') ";
        $resultado = mysqli_query($conexion,$consulta);
        while($registro = mysqli_fetch_array($resultado)){
        $result["idDocumentoPersona"]=$registro['idDocumentoPersona'];
        $result["perNombres"]=$registro['perNombres'];
        $result["perApellidos"]=$registro['perApellidos'];
        $result["repEstado"]=$registro['repEstado'];  
        $json['consulta'][]=$result;      
        }

        mysqli_close($conexion);
        echo json_encode($json);

?>