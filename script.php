<?php 
header("Access-Control-Allow-Origin: *");
define("HUBTOKEN","pat-na1-db967db6-f1ae-4588-bdc4-21b6f56a590e");
// Get the raw POST data
$postData = file_get_contents('php://input');

// Decode the JSON data
$request = json_decode($postData, true);
$apiUrl = $request['apiUrl'];
$body = $request['body'];
function hub_post($url,$json=""){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($json));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer ".HUBTOKEN,"Content-Type: application/json"));
    $response = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return $response;
}

// Execute cURL request
$response = hub_post($apiUrl,$body);
// $response = json_decode($response);
echo $response;

