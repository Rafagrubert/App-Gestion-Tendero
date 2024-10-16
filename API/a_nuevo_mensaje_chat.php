<?php

include 'conexion.php';
$c_id_orden=$_POST['id_Orden'];
$c_id_usuario=$_POST['id_usuario'];
$c_mensaje=$_POST['mensaje'];
$c_imagen=$_POST['imagen'];

$json = array();
        

        $consulta="CALL sp_a_nuevo_mensaje_chat({$c_id_orden},{$c_id_usuario},'{$c_mensaje}','{$c_imagen}');"; 
        mysqli_query($conexion,$consulta) or die (mysqli_error($conexion));

        mysqli_close($conexion);
        

?>