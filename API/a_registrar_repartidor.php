<?php

include 'conexion.php';

$json=array();
    if(isset($_GET["tipo"]) &&
    isset($_GET["nombre"]) &&
    isset($_GET["placa"]) &&
    isset($_GET["documento"])){
        $tipo=$_GET['tipo'];
        $nombre=$_GET['nombre'];
        $placa=$_GET['placa'];
        $documento=$_GET['documento'];

        $consulta="CALL sp_a_repartidor_reg('{$tipo}','{$nombre}','{$placa}','{$documento}')";
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