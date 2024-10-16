<?php

include 'conexion.php';
$c_id_orden=$_GET['id_Orden'];

$json = array();
        

        $consulta="CALL sp_c_consultar_mensajes_chat_x_orden({$c_id_orden})"; 
        $resultado = mysqli_query($conexion,$consulta);

        while($registro = mysqli_fetch_array($resultado)){
        $result["idChat"]=$registro['idChat'];
        $result["idUsuario"]=$registro['idUsuario'];
        $result["ruNombre"]=$registro['ruNombre'];
        $result["perNombres"]=$registro['perNombres'];        
        $result["usuImagen"]=$registro['usuImagen'];
        $result["menFechaEnvio"]=$registro['menFechaEnvio'];
        $result["menContenido"]=$registro['menContenido'];
        $result["menImagen"]=$registro['menImagen'];
        
        $json['consulta'][]=$result;   
        
    
        }

        mysqli_close($conexion);
        echo json_encode($json);
        

?>