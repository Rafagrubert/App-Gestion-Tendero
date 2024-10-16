<?php
include 'conexion.php';

$json=array();

    if(isset($_GET["idpersona"])){
        $idpersona=$_GET['idpersona'];
        
        $consulta="CALL sp_c_consultar_codigo_tienda_soporte('".$idpersona."')";
        $resultado=mysqli_query($conexion,$consulta);

        if($registro=mysqli_fetch_array($resultado)){
            $json['CodTienda'][]=$registro;
        }
        else{
            $resultar["idTienda"]='no registra';
            $json['CodTienda'][]=$resultar;
            }
        mysqli_close($conexion);
        echo json_encode($json);
    }
    else{
            $resultar["success"]=0;
            $resultar["message"]='WS no retorna';
            $json['CodTienda'][]=$resultar;
            echo json_encode($json);
        }
?>