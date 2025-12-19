<?php
// Query
$id_customer = $_SESSION['id_customer'] ?? null;
$product_output;
$subtotal = 0;
$sql = "SELECT *
        FROM `022_view_customers_shopping_cart`
        WHERE id_customer = '$id_customer';";
// Execute the query
// Open connection
include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/config/connection.php');
$query_result = mysqli_query($conn, $sql);
// Check if the query exists and if there was rows affected
if (!$query_result) {
  $product_output = "Product with ID $id_product not found.";
}
