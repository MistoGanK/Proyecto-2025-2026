<?php
header("Content-Type: application/json");

$raw = file_get_contents("php://input");
$data = json_decode($raw, true);

// DEBUG: log en lugar de echo
error_log("RAW POST: $raw");
error_log("Decoded: " . print_r($data, true));

$key = $data['apiKey'] ?? null;

// Query ApiKey (Test)
$sqlApi = "
SELECT api_key 
FROM `022_vendors_api_keys`
WHERE api_key = '$key';
";

$sql = 'SELECT * FROM `022_products` LIMIT 5;';

include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/config/connection.php');

$resultApiCheck = mysqli_query($conn, $sqlApi);

if ($key && mysqli_num_rows($resultApiCheck) > 0) {
    $products = mysqli_query($conn, $sql);
    $assocProducts = mysqli_fetch_all($products, MYSQLI_ASSOC);
    $jsonProducts = json_encode($assocProducts);
    echo json_encode($jsonProducts);
} else {
    echo json_encode(["error" => "Wrong apikey"]);
}
