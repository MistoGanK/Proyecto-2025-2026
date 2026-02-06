<?php
// Sending my products to the sellers
header("Content-Type: application/json");

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
    img_src AS "product_image",
    price AS "product_price",
    stock AS "product_stock"
    FROM `022_products` LIMIT 5;';

include(__DIR__ . '/../../config/connection.php');

$resultApiCheck = mysqli_query($conn, $sqlApi);

if ($key && mysqli_num_rows($resultApiCheck) > 0) {
    
    $products = mysqli_query($conn, $sql);
    $assocProducts = mysqli_fetch_all($products, MYSQLI_ASSOC);
    $response = json_encode($assocProducts);

    echo $response;
} else {
    echo json_encode(["error" => "Wrong apikey"]);
}
