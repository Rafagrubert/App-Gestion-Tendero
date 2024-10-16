<?php
include 'conexion.php';
$c_idten=$_GET['idten'];
$c_idrep=$_GET['idrep'];

$consulta="CALL sp_a_contrata_rep(".$c_idten.",".$c_idrep.")";
mysqli_query($conexion,$consulta) or die (mysqli_error($conexion));
$consulta="CALL sp_c_tienda_repartidor('{$c_idrep}')";
        $resultado=mysqli_query($conexion,$consulta);

        if($fila = mysqli_fetch_array($resultado)){
            $json['Nombre']=$fila['tieNombre'];
        }
        mysqli_close($conexion);
        echo json_encode($json);
?>