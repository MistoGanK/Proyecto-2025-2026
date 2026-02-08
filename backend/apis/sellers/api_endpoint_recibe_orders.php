<?php

header('Content-Type: application/json');

include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/config/connection.php');

$apikey = $_GET['apikey'] ?? null;
$ordersJson = $_GET['orders_json'] ?? null;
$errors = [];

if (!$apikey) {
    http_response_code(401);
    echo json_encode(["success" => false, "errors" => ["API key missing"]]);
    exit;
}
// Check API key

$sqlApi = "SELECT * FROM `022_sellers_api_keys` WHERE api_key = '$apikey' ";
$resultApiCheck = mysqli_query($conn, $sqlApi);
$sellerInfo = mysqli_fetch_assoc($resultApiCheck);

if ($sellerInfo && mysqli_num_rows($resultApiCheck) > 0) {
} else {
    http_response_code(403);
    echo json_encode(["success" => false, "errors" => ["Invalid API => " . $apikey]]);
    exit;
}

$input = json_decode(urldecode($ordersJson), true);

if (!is_array($input)) {
    http_response_code(400);
    echo json_encode(["success" => false, "errors" => ["Invalid JSON structure"]]);
    exit;
}

// Generating new id_order
$sqlIdOrder = "SELECT COALESCE(MAX(id_order), 0) + 1 AS 'max_id' FROM `022_orders`";
$resultNewIdOrder = mysqli_query($conn, $sqlIdOrder);

if (!$resultNewIdOrder) {
    $errors[] = "SQL error: " . mysqli_error($conn);
}

$rowId = mysqli_fetch_assoc($resultNewIdOrder);

$newIdOrder = ($rowId['max_id'] ?? 1);

$idSeller = $sellerInfo['id_seller'];

foreach ($input as $order) {
    // Validate if product code && quantity are recibed
    if (
        !isset($order['product_code']) || empty($order['product_code'])
        ||
        !isset($order['product_quantity']) || empty($order['product_quantity'])
    ) {
        $orderNumber = $order['order_number'] ?? null;
        $errors[] = "Empy key fields not allowed for product_code && product_quantity on order_number: "
            . "$orderNumber";
        continue;
    }
    // Order Fields
    $customer_forename = $order['customer_forename'];
    $customer_surname = $order['customer_surname'];
    $customer_nif = $order['customer_nif'];
    $customer_email = $order['customer_email'];
    $customer_phone = $order['customer_phone'];
    $customer_address = $order['customer_address'];
    $customer_location = $order['customer_location'];
    $customer_country = $order['customer_country'];
    $product_id = $order['product_code'];
    $product_qty = $order['product_quantity'];

    // Get product price 
    $sqlPrice = "SELECT price FROM `022_products` WHERE id_product = $product_id";
    $resultPrice = mysqli_query($conn, $sqlPrice);

    if (!$resultPrice) {
        $productPrice = 0;
        $errors[] = "SQL error: " . mysqli_error($conn);
    } else {
        $rowPrice = mysqli_fetch_assoc($resultPrice);
        $productPrice = $rowPrice['price'] ?? 0;
    }

    $totalProduct = $productPrice * $product_qty;

    // Order Query
    $sqlOrder = "INSERT INTO `022_orders` 
        (id_order,
        id_product,
        id_payment_method,
        id_supplier,
        qty,
        unit_price,
        total,
        order_date)

        VALUES(
        $newIdOrder,
        $product_id,
        1,
        $idSeller,
        $product_qty,
        $productPrice,
        $totalProduct,
        NOW()
        )";

    if (!mysqli_query($conn, $sqlOrder)) {
        $errors[] = "SQL error: " . mysqli_error($conn);
    }
}
// Final debuggin response for the caller
echo json_encode([
    "success" => count($errors) == 0,
    "errors" => $errors,
    "processed_order" => $newIdOrder
]);
