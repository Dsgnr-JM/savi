<?php 
    function getCurl( string $params){
        $ch = curl_init();

        $url = "http://localhost/SAVI/dashboard/api/?" . $params;

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        if($response){
            return json_decode($response, true);
        }
    }
 ?>