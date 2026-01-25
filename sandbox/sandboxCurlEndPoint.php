<?php 
// Variables
$apiKey = 'zpka_12b7197a19df4f349e86a877dec3359c_d7027ca7';
$cityKey = '305482';
$uCurlUrl = "https://dataservice.accuweather.com/currentconditions/v1/" . $cityKey . "?apikey=" . $apiKey;

$ch = curl_init();

$headers = array(
    "Content-Type: application/json",
    "Authorization: Bearer " . $apiKey
);

// Configuración de cURL
curl_setopt($ch, CURLOPT_URL, $uCurlUrl);

curl_setopt($ch, CURLOPT_HTTPGET, true); 

// Pasamos los headers correctamente
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

curl_setopt($ch, CURLOPT_POSTFIELDS, array("key" => "idKEY"));


// Ejecución
$result = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Error en cURL: ' . curl_error($ch);
} else {
    echo $result;
    // Save the information on logs
    $time = date("c",time());
    $routeFile = $_SERVER['DOCUMENT_ROOT'] . '/student022/backend/logs/weatherLogs.txt';
    $file = fopen($routeFile, "a+");
    $txt = json_encode($result, JSON_PRETTY_PRINT);
    fwrite($file,$txt);
    fclose($file);

    // Save the JSON to table $txt -> Last Update

    // Connection
    include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/config/connection.php');

    $scapedJson = mysqli_real_escape_string($conn, $txt);
    $sql = "INSERT INTO `022_weather_api` (json_weather) VALUES ('$scapedJson')";
    
    if(mysqli_query($conn,$sql)){

    }else{

    }
}

curl_close($ch);
?>