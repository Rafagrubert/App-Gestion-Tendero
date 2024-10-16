<?php

include 'conexion.php';
$c_id_Tienda=$_GET['id_Tienda'];

$json = array();
        

        $consulta="CALL sp_c_mostrar_detalle_publicidad({$c_id_Tienda})"; 
        $resultado = mysqli_query($conexion,$consulta);

        while($registro = mysqli_fetch_array($resultado)){
        $result["pubImagen"]=$registro['pubImagen'];
        $result["pubTitulo"]=$registro['pubTitulo'];
        $result["pubDescripcion"]=$registro['pubDescripcion'];        
        $result["pubFechaInicio"]=$registro['pubFechaInicio'];
        $result["fecha_Dias"]=$registro['fecha_Dias'];
        $result["factpubMontoTotal"]=$registro['factpubMontoTotal'];
        $result["tasa"]=$registro['tasa'];
        $result["pubCantVistas"]=$registro['pubCantVistas'];
        
        $json['D_publicidad'][]=$result;   
        
    
        }

        mysqli_close($conexion);
        echo json_encode($json);
        

?>