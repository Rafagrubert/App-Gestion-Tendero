<?php

include 'conexion.php';

$json=array();
    if(isset($_GET["iDocumentoPersona"])){
        $iDocumentoPersona=$_GET['iDocumentoPersona'];

        $consulta="CALL sp_c_nombre_por_dni_repartidor('{$iDocumentoPersona}')";
        $resultado=mysqli_query($conexion,$consulta);

        if($fila = mysqli_fetch_array($resultado)){
            $json['Nombre']="{$fila['perApellidos']} {$fila['perNombres']}";
            $json['Imagen']=$fila['usuImagen'];
            $json['idRepartidor']=$fila['idRepartidor'];
            $json['idUsuario']=$fila['idUsuario'];
        }
        mysqli_close($conexion);
        echo json_encode($json);
    }
?>