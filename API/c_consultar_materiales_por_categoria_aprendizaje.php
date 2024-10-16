<?php

include 'conexion.php';
$c_categoria_apre=$_GET['categoria'];
$c_id_persona=$_GET['idpersona'];

$json = array();
        $consulta="CALL sp_c_consultar_materiales_por_categoria_aprendizaje('{$c_categoria_apre}','{$c_id_persona}')";
        $resultado = mysqli_query($conexion,$consulta);
        while($registro = mysqli_fetch_array($resultado)){
        $result["idAprendizaje"]=$registro['idAprendizaje'];
        $result["apreTituloRecurso"]=$registro['apreTituloRecurso'];
        $result["apreContenido"]=$registro['apreContenido'];
        $result["apreperLike"]=$registro['apreperLike'];
        
        $json['matCategoria'][]=$result;
        }

        mysqli_close($conexion);
        echo json_encode($json);


?>
