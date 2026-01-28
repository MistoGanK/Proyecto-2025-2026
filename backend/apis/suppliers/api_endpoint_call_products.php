<?php
// Variables
// Replace for Johns API key && uCurl
$apiKey = '10203040F';
$data = json_encode([
  "apiKey" => $apiKey
]);

$uCurlUrl = "https://remotehost.es/student022/backend/apis/sellers/api_endpoint_send_products.php";

$ch = curl_init();

//  --- Problems ---
$headers = array(
  "Content-Type: application/json",
  "Content-Length: " . strlen($data)
);

// Configuración de cURL
curl_setopt($ch, CURLOPT_URL, $uCurlUrl);

// Pasamos los headers correctamente 
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // False for localhost True for remotehost
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_VERBOSE, true);

curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

// Ejecución
$result = curl_exec($ch);

if (curl_errno($ch)) {
  echo 'Error en cURL: ' . curl_error($ch);
} else {
  // Save the resul t
  $data = json_decode($result);
  if(is_string($data)){
    $data = json_decode($data,true);
  }
  echo gettype($data);
  // Loop the vields
  foreach($data as $product){
    print_r($product['id_product']);
  }
  // echo $result;
}

curl_close($ch);
