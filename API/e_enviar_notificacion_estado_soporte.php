<?php
    
    function sendPushNotificationActividad($to = '', $data = array()) {
        
        $apiKey = 'AAAAylxXRRU:APA91bHzti7FuhmckfJZXrMSL0lO3nXifczwa1-jNzrpofOxW1ixrpDCw_QvaoVWaKV7E8yoJ3tKvVq6rVtKOh_OfoPRF8Z501ggQh4IhbkS1O0qVpv5IhFai0CfHcvrt-bAj2ATks1i';
        
        $fields = array(
                        'to' => $to,
                        'data' => $data,
                        );
        
        $headers = array('Authorization: key='.$apiKey, 'Content-Type: application/json');
        
        $url = 'https://fcm.googleapis.com/fcm/send';
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        
        echo json_encode($fields);
        echo "<br><br>RESPUESTA SERVIDOR: ";
        
        $result = curl_exec($ch);
        
        curl_close($ch);
        
        return json_decode($result, true);
    }
    
    // DATOS DE  LOS DESTINATARIOS
    include 'conexion.php';
    $id_persona_ests=$_GET['id_persona_ests'];
    $id_orden_re=$_GET['id_orden_re'];
    $desc_tipo=$_GET['desc_tipo'];
    $desc_estado=$_GET['desc_estado'];

         $data = array(
                  'title' => $desc_tipo,
                  'body' => $desc_estado,
                  );
     $consulta="CALL sp_a_registrar_notificaciones_estado_soporte('".$id_persona_ests."','".$id_orden_re."','".$desc_tipo."','".$desc_estado."')";
     $resultado = mysqli_query($conexion,$consulta);
     while($registro = mysqli_fetch_array($resultado)){
          $result["usuToken"]=$registro['usuToken'];
          $json['Tokensoporte'][]=$result;
     }
     mysqli_close($conexion);
    $to = $result["usuToken"];
    //$to = "daTHdW0CTp2ab6SX25IvqZ:APA91bF-zGLtD069N2OLbf0SMwUVbxgQ3AEtgAUEf8ZXB-SahTmgYMhhDZ8SR0o4ss1X1I6z9bcX-IOSgeE5tTgUe-XTrThT6ZrdbohrgPE0Q2vJaoJx4nmWdcuL5wSDGqCvJOiS4Mvo";
    //$to = "/topics/dispositivos";
    //sendPushNotification($to,  $data)
    print_r(sendPushNotificationActividad($to,  $data));
    
    ?>
