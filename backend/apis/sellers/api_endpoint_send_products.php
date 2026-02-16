<?php
// Sending my products to the sellers
header("Content-Type: application/json");
<<<<<<< HEAD

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
=======

$raw = file_get_contents("php://input");

$key = $_GET['apikey'] ?? null;

// Check API key
$sqlApi = "
SELECT api_key 
FROM `022_sellers_api_keys`
WHERE api_key = '$key';
";

$sql = 'SELECT
    id_product AS "product_id",
    product_name AS "product_name",
    AS "product_image",
    price AS "product_price",
    stock AS "product_stock",
    description AS product_desc
    FROM `022_products` LIMIT 5;';

include(__DIR__ . '/../../config/connection.php');
>>>>>>> a14dd0e4f5e1f5d6fb545925a0648fc8e211543a

$resultApiCheck = mysqli_query($conn, $sqlApi);

if ($key && mysqli_num_rows($resultApiCheck) > 0) {
<<<<<<< HEAD
    $products = mysqli_query($conn, $sql);
    $assocProducts = mysqli_fetch_all($products, MYSQLI_ASSOC);
    echo json_encode($assocProducts);
=======
    
    $products = mysqli_query($conn, $sql);
    $assocProducts = mysqli_fetch_all($products, MYSQLI_ASSOC);
    $response = json_encode($assocProducts);

    echo $response;
>>>>>>> a14dd0e4f5e1f5d6fb545925a0648fc8e211543a
} else {
    echo json_encode(["error" => "Wrong apikey"]);
}
