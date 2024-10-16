<?php
    
    function sendPushNotification($to = '', $data = array()) {
        
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
    //$to = "cOXj3NXmBD8:APA91bEVt28g81V6bPl-NJxW8KiWaySnCBXy3gyGkusRRELoqKhONpsFp8P2tlBq7uPNh0H-zKEo55rKflqb0imDsw99j--u-OkLN1TRSA11AwItdqrPRGrwoCf1VPV7XgFJIveYSHa2";
    $to = "/topics/dispositivos";
    //$to = "cYSAGrcrSveCl9HTf48MY6:APA91bFRu0DUuF3VMJ2MvcaNzFW";

    // DATOS DE LA NOTIFICACION
    $data = array(
                  'title' => 'Bienvenido',
                  'body' => 'Bienvenido a encargalo',
                  );
    
    //sendPushNotification($to,  $data)
    print_r(sendPushNotification($to,  $data));
    
    ?>
