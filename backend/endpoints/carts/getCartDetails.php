<?php
session_start();
header('Content-Type: application/json');
include(__DIR__ . '/../../config/connection.php');

$response = [
    'items' => [],
    'total' => 0
];

// Logged User
if (isset($_SESSION['id_customer'])) {
    $id_customer = $_SESSION['id_customer'];

    $sql = "SELECT 
                sc.id_product, 
                sc.qty, 
                p.product_name, 
                p.price, 
                p.img_src
            FROM `022_shopping_cart` sc
            JOIN `022_products` p ON sc.id_product = p.id_product
            WHERE sc.id_customer = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_customer);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_assoc($result)) {
        $response['items'][] = $row;
    }

} 
// Guest User (Cookies)
else if (isset($_COOKIE['shopping_cart'])) {
    $cookie_cart = json_decode($_COOKIE['shopping_cart'], true);

    if (!empty($cookie_cart)) {
        foreach ($cookie_cart as $id => $qty) {
            $sql = "SELECT id_product, product_name, price, img_src 
                    FROM `022_products` 
                    WHERE id_product = ? LIMIT 1";
            
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);

            if ($prod = mysqli_fetch_assoc($res)) {
                $prod['qty'] = $qty;
                $response['items'][] = $prod;
            }
        }
    }
}

// Total
foreach ($response['items'] as $item) {
    $response['total'] += ($item['price'] * $item['qty']);
}

echo json_encode($response);