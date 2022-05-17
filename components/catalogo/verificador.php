<?php 
print_r($_GET);
$ClientID="AT0xqtQTZEvYJ6_aokWIVvW2GsP5EAogcndAvXgYhKfWa6N7XuXDNEQvTE1zRvzvEGRposSvzxtNRxZh";
$Secret="EAf2gegJvgJjBaPAGjExa8ozLCMXgEL_RhKTbpyyb-yuNNyVKZeO7QDI8VGgV2V34H_i7XG0o-Bw36I2";

    $Login= curl_init("https://api-m.sandbox.paypal.com/v1/oauth2/token");
    curl_setopt($Login,CURLOPT_RETURNTRANSFER,TRUE);
    curl_setopt($Login,CURLOPT_USERPWD,$ClientID.":".$Secret);
    curl_setopt($Login, CURLOPT_POSTFIELDS,"grant_type=client_credentials");
    $Respuesta=curl_exec($Login);

    $objRespuesta=json_decode($Respuesta);
    $AccessToken=$objRespuesta->access_token;
    print_r($AccessToken);

    $ventas = curl_init("https://api-m.paypal.com/v1/payments/payment/".$_GET['paymentID']);
    curl_setopt($venta,CURLOPT_HTTPHEADER,array("Content-Type: application/json","Authorization: Bearer".$AccessToken));
    $RespuestaVenta= curl_exec($venta);
    print_r($RespuestaVenta);
?>