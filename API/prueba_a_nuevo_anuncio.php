<?php
include 'conexion.php';

if(
    isset($_POST['pathImg'])
    && isset($_POST['titulo'])
    && isset($_POST['descripcion'])
    && isset($_POST['linkRed'])
    && isset($_POST['fechaInicio'])
    && isset($_POST['fechaFin'])
    && isset($_POST['idTienda'])
    && isset($_POST['montoPubli'])
    && isset($_POST['fechaPago'])
    ){if(
        empty($_POST['pathImg'])
        && empty($_POST['titulo'])
        && empty($_POST['descripcion'])
        && empty($_POST['fechaInicio'])
        && empty($_POST['fechaFin'])
        && empty($_POST['idTienda'])
        && empty($_POST['montoPubli'])
        && empty($_POST['fechaPago'])
        ){
            $c_imagen=$_POST['pathImg'];
            $c_titulo=$_POST['titulo'];
            $c_descripcion=$_POST['descripcion'];
            $c_linkRedi=$_POST['linkRed'];
            $c_fechaI=$_POST['fechaInicio'];
            $c_fechaF=$_POST['fechaFin'];
            $c_id_tienda=$_POST['idTienda'];
            $c_monto=$_POST['montoPubli'];
            $c_fechaP=$_POST['fechaPago'];
        
                if(empty($_POST['pathImg'])){
                    $imagePath = "";
                }else{
                    //Generación de un codigo único
                    $filePath = uniqid($c_id_tienda);
                    //Construimos la ruta de la imagen
                    $imagePath = "imgPublicaciones/$filePath.jpg";
                    //Insertamos la imagen en el directorio del servidor
                    file_put_contents($imagePath,base64_decode($c_imagen));
        }
            $consulta="CALL sp_a_nuevo_anuncio('".$imagePath."','".$c_titulo."','".$c_descripcion."','".$c_linkRedi."',
            '".$c_fechaI."','".$c_fechaF."',".$c_id_tienda.",".$c_monto.",'".$c_fechaP."')";
            mysqli_query($conexion,$consulta) or die (mysqli_error($conexion));
        
        
        mysqli_close($conexion);            
               
            
    
        }    else {
            echo 'Parametros vacios';
        }
                

    }    else {
        echo 'Parametros incompletos';
    }

?>