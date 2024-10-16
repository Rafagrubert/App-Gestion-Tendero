<?php
include 'conexion.php';
$c_id_DocumentoPersona=$_GET['id_DocumentoPersona'];

$json = array();
        $consulta="CALL sp_c_perfil_usuario('".$c_id_DocumentoPersona."') ";
        $resultado = mysqli_query($conexion,$consulta);
        while($registro = mysqli_fetch_array($resultado)){
        $result["idDocumentoPersona"]=$registro['idDocumentoPersona'];
        $result["perNombres"]=$registro['perNombres'];
        $result["perApellidos"]=$registro['perApellidos'];
        $result["perNumeroCelular"]=$registro['perNumeroCelular'];  
        $result["perUbiLatitud"]=$registro['perUbiLatitud'];
        $result["perUbiLongitud"]=$registro['perUbiLongitud'];
        $result["repEstado"]=$registro['repEstado'];
        $result["repTipoVehiculo"]=$registro['repTipoVehiculo'];
        $result["repNombreVehiculo"]=$registro['repNombreVehiculo']; 
        $result["repPlaca"]=$registro['repPlaca']; 
        $json['consulta'][]=$result;      
        }

        mysqli_close($conexion);
        echo json_encode($json);

?>