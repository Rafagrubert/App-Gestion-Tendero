<?php
include 'conexion.php';
$p_provNombre=$_POST['provNombre'];
$p_provDireccion=$_POST['provDireccion'];
$p_provCiudad=$_POST['provCiudad'];
$p_provDistrito=$_POST['provDistrito'];
$p_provCorreo=$_POST['provCorreo'];
$p_provTelefono=$_POST['provTelefono'];
$p_provRFC=$_POST['provRFC'];

$json = array();
        $consulta="CALL sp_a_reg_proveedor_almacen('".$p_provNombre."','".$p_provDireccion."','".$p_provCiudad."','".$p_provDistrito."','".$p_provCorreo."','".$p_provTelefono."','".$p_provRFC."')";
        $resultado = mysqli_query($conexion,$consulta);
        if($resultado){
            echo "Proveedor insertado";
        }

        mysqli_close($conexion);
        echo json_encode($json);
?>
