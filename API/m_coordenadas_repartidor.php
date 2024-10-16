<?php

include 'conexion.php';

$json=array();
    if(isset($_GET["idOrden"])
    && isset($_GET["Latitud"]) 
    && isset($_GET["Longitud"]) ){
        $idOrden=$_GET['idOrden'];
        $Latitud=$_GET['Latitud'];
        $Longitud=$_GET['Longitud'];

        $consulta="CALL sp_m_coordenadas_repartidor('{$idOrden}','{$Latitud}','{$Longitud}')";
        $resultado=mysqli_query($conexion,$consulta);
        if($fila = mysqli_fetch_array($resultado)){
            if($fila['odLatitudEntregaTR'] == $Latitud && $fila['odLongitudEntregaTR'] == $Longitud){
                $json = 1;
            }else{
                $json = 0;
            }
        }
        mysqli_close($conexion);
        echo $json;
    }
?>