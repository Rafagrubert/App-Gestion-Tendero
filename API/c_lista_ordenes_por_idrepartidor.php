<?php
include 'conexion.php';

$json=array();
if(isset($_GET["idrepartidor"])){
    $idrepartidor=$_GET['idrepartidor'];
    $consulta="CALL sp_c_lista_ordenes_por_idrepartidor('{$idrepartidor}')";
    $resultado=mysqli_query($conexion,$consulta);
    while($fila = mysqli_fetch_array($resultado)){
        $json['Consulta'][]= $fila;
    }
mysqli_close($conexion);
    echo json_encode($json);
}else{
    die("Fallo la conexion");
}
?>