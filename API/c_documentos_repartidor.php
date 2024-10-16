<?php
include 'conexion.php';
$c_id_DocumentoPersona=$_GET['id_DocumentoPersona'];

$json = array();
        $consulta="CALL sp_c_documentos_repartidor('".$c_id_DocumentoPersona."') ";
        $resultado = mysqli_query($conexion,$consulta);
        while($registro = mysqli_fetch_array($resultado)){
        $result["idDocumentoPersona"]=$registro['idDocumentoPersona'];
        $result["repEstado"]=$registro['repEstado'];
        $result["repTipoVehiculo"]=$registro['repTipoVehiculo'];
        $result["repPlaca"]=$registro['repPlaca'];  
        $result["repAntecedentes"]=$registro['repAntecedentes'];
        $result["repAntecedentesEstado"]=$registro['repAntecedentesEstado'];
        $result["repLicencia"]=$registro['repLicencia'];
        $result["repLicenciaEstado"]=$registro['repLicenciaEstado'];
        $result["repDocumentoVehiculo"]=$registro['repDocumentoVehiculo']; 
        $result["repDocumentoVehiculoEstado"]=$registro['repDocumentoVehiculoEstado'];
        $result["repTarjetaPropiedad"]=$registro['repTarjetaPropiedad']; 
        $result["repTarjetaPropiedadEstado"]=$registro['repTarjetaPropiedadEstado'];  
        $json['consulta'][]=$result;      
        }

        mysqli_close($conexion);
        echo json_encode($json);

?>