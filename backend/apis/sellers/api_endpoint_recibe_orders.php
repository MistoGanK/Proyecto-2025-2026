<?php
// Sending my products to the sellers
header("Content-Type: application/json");
$errors = [];
$raw = file_get_contents("php://input");

$key = $_GET['apikey'] ?? null;

$data = json_decode($raw, true);

if (!is_array($data)) {
    // Server Response
    echo json_encode(["error" => "Wrong JSON FORMAT, NOT ARRAY"]);
    exit;
}

// Check API key
$sqlApi = "
SELECT api_key 
FROM `022_sellers_api_keys`
WHERE api_key = '$key';
";

include(__DIR__ . '/../../config/connection.php');

$resultApiCheck = mysqli_query($conn, $sqlApi);

if ($key && mysqli_num_rows($resultApiCheck) > 0) {

    foreach ($data as $orderLine) {
        $id_order = $orderLine['order_number'];
        $id_customer = 152;
        $id_product = $orderLine['product_id'];
        $qty = $orderLine['product_quantity'];
        $order_date = $orderLine['order_placed_on'];

        // Insert to orders
        $sql =
            "INSERT INTO `022_orders`(id_order,id_customer,id_product,qty,order_date)
            VALUES($id_order,$id_customer,$id_product,$qty,$order_date); 
    ";
        if (!mysqli_query($conn, $sql)) {
            $errors[] = "Order: $id_order, Product: $id_product could not be inserted.";
            print_r($errors);
        }
    }
} else {
    echo json_encode(["error" => "Wrong apikey"]);
}
