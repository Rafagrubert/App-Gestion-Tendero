<?php
$hostname='localhost';
$username ='root';
$password='';
$database ='dbencargalov2';

$conexion = mysqli_connect($hostname,$username,$password,$database);

if( mysqli_connect_errno() ){
    echo "Conexion fallida: " . mysqli_connect_error();
}else{
    
}



?>