<?php

include 'conexion.php';

$json=array();



if(
    isset($_POST["sp_usuCorreo"])
    && isset($_POST["sp_usuImagen"])
    && isset($_POST["sp_idRolUsuario"])
    && isset($_POST["sp_idDocumentoPersona"])
    && isset($_POST["sp_perNombres"])
    && isset($_POST["sp_perApellidos"])
    && isset($_POST["sp_perTipo"])
    && isset($_POST["sp_perNumeroCelular"])
    && isset($_POST["sp_perUbiLatitud"])
    && isset($_POST["sp_perUbiLongitud"])
    
    )
    
    {


    $sp_usuCorreo=$_POST["sp_usuCorreo"]; 
    $sp_usuImagen=$_POST["sp_usuImagen"]; 
    $sp_idRolUsuario=$_POST["sp_idRolUsuario"]; 
    $sp_idDocumentoPersona=$_POST["sp_idDocumentoPersona"]; 
    $sp_perNombres=$_POST["sp_perNombres"]; 
    $sp_perApellidos=$_POST["sp_perApellidos"]; 
    $sp_perTipo=$_POST["sp_perTipo"]; 
    $sp_perNumeroCelular=$_POST["sp_perNumeroCelular"]; 
    $sp_perUbiLatitud=$_POST["sp_perUbiLatitud"]; 
    $sp_perUbiLongitud=$_POST["sp_perUbiLongitud"]; 

    
    
    //Verificación de existencia de ruta imagen
    if(empty($sp_usuImagen)){
        $imagePath = "";
    }else{
        //Generación de codigo único
        $filePath = uniqid($sp_idDocumentoPersona);
        //Construimos la ruta de la imagen
        $imagePath = "imgUsuarios/".$filePath.".jpg";
        //Insertando imagen en el directorio del servidor
        file_put_contents($imagePath, base64_decode($sp_usuImagen));
    }

    
    
            
    $consulta="call sp_a_registro_usuario_inicio_sesion(
        '{$sp_usuCorreo}', 
        '{$imagePath}',
         {$sp_idRolUsuario},
        '{$sp_idDocumentoPersona}',
        '{$sp_perNombres}',
        '{$sp_perApellidos}',
        '{$sp_perTipo}',
        '{$sp_perNumeroCelular}',
        '{$sp_perUbiLatitud}',
        '{$sp_perUbiLongitud}'
        );";

    
    $resultado=mysqli_query($conexion,$consulta);

    
    while($registro=mysqli_fetch_array($resultado)){
        $result["idUsuario"]=$registro['idUsuario']; 
        $result["idRolUsuario"]=$registro['idRolUsuario']; 
        $json['datos_usuario'][]=$result;
    };
    
    mysqli_close($conexion);
    echo json_encode($json);
  
}

?>