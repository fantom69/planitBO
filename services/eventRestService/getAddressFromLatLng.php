<?php
    header('Access-Control-Allow-Origin: *');    
    header('Access-Control-Allow-Headers: X-Requested-With');
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
   

    $data = (array) json_decode(file_get_contents('php://input')); 

    $lat = $data['lat'];
    $lng = $data['lng'];

    $curl = curl_init("http://maps.googleapis.com/maps/api/geocode/json?latlng=".$lat.",".$lng."&sensor=true'");
    $return = curl_exec($curl);
    curl_close($curl);

?>