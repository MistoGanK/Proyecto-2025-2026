<?php 
echo '--- Sanbox Joshn Call ---';
// Variables
  // Replace for Johns API key && uCurl
$apiKey = '10203040F';
$uCurlUrl = "https://remotehost.es/student022/backend/apis/sellers/api_endpoint_send_products.php";

$ch = curl_init();

//  --- Problems ---
$headers = array(
    "Content-Type: application/json"
    // "Authorization: Bearer " . $apiKey
);

// Configuración de cURL
curl_setopt($ch, CURLOPT_URL, $uCurlUrl);

// curl_setopt($ch, CURLOPT_HTTPGET, true); 

// Pasamos los headers correctamente 
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true); // False for localhost True for remotehost
curl_setopt($ch, CURLOPT_POST,true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);

curl_setopt($ch, CURLOPT_POSTFIELDS, array("apiKey" => "$apiKey"));

// Ejecución
$result = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Error en cURL: ' . curl_error($ch);
} else {
    echo "John view";
    echo $result;
}

curl_close($ch);
?>