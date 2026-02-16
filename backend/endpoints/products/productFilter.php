<?php
session_start();

$filterDateIn  = htmlspecialchars($_GET['filterDateIn'] ?? '');
$filterDateOut = htmlspecialchars($_GET['filterDateOut'] ?? '');
$orderSelected = htmlspecialchars($_GET['inputSelect'] ?? 'ASC');

$query = "
      SELECT * FROM `022_products`
      WHERE 
        inserted_date BETWEEN '$filterDateIn' AND '$filterDateOut'
      ORDER BY '$orderSelected'
      LIMIT 10;
    ";

include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/config/connection.php');
$result = mysqli_query($conn, $query);
// $products = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Include the function showProducts()
include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/functions/products/showProducts.php');
showProducts($result);

// $products_json = json_encode($products);
// echo $products_json;
mysqli_close($conn);
