<?php
// For testing
// Simulating John access
$apiKey = '10203040F';

$uCurlUrl = "http://localhost/student022/backend/apis/sellers/api_endpoint_send_products.php?apikey=" . urlencode($apiKey);

// $uCurlUrl = "https://remotehost.es/student014/shop/backend/endpoints/product_seller.php";

$ch = curl_init();

$headers = array(
  "Content-Type: application/json"
);

// Configuración de cURL
curl_setopt($ch, CURLOPT_URL, $uCurlUrl);

// Pasamos los headers correctamente 
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HTTPGET, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_VERBOSE, true);

// curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

// Ejecución
$result = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Error en cURL: ' . curl_error($ch);
} else {
    // var_dump($result);
    // echo $result;
    $products = json_decode($result, true);
    if (!is_array($products)) {
        echo "Invalid JSON from server (NOT ARRAY)";
    } else {
        foreach ($products as $product) {
            print_r($product);
        }
    }
}

curl_close($ch);
