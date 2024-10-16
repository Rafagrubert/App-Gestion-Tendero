<?php
include 'conexion.php';

$json=array();
if(isset($_GET["documento"])){
    $documento=$_GET['documento'];
    $consulta="CALL sp_c_existe_repartidor('{$documento}')";
    $resultado=mysqli_query($conexion,$consulta);
    if($fila = mysqli_fetch_array($resultado)){
        $json['EXISTE'] = $fila['EXISTE'];
    }
    mysqli_close($conexion);
    echo json_encode($json);
}else{
    die("Fallo la conexion");
}
?>