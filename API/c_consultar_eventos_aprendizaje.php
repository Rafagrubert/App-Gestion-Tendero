<?php

include 'conexion.php';


$json = array();
        $consulta="CALL sp_c_consultar_eventos_aprendizaje()"; 
        $resultado = mysqli_query($conexion,$consulta);
        while($registro = mysqli_fetch_array($resultado)){
        $result["idEventosV"]=$registro['idEventosV'];
        $result["evFechaPublicacion"]=$registro['evFechaPublicacion'];
        $result["evEstado"]=$registro['evEstado'];
        $result["evTitulo"]=$registro['evTitulo'];
        $result["evDescripcion"]=$registro['evDescripcion'];
        $result["evLink"]=$registro['evLink'];
        
        $json['eventos'][]=$result;
        }

        mysqli_close($conexion);
        echo json_encode($json);


?>
