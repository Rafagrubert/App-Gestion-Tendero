<?php
include 'conexion.php';


$json = array();

        $consulta="CALL sp_c_consultar_categoria_aprendizaje()";
        $resultado = mysqli_query($conexion,$consulta);
        while($registro = mysqli_fetch_array($resultado)){
        $result["apreCategoriaRecurso"]=$registro['apreCategoriaRecurso'];

        $json['categrias'][]=$result;
        }

        mysqli_close($conexion);
        echo json_encode($json);


?>