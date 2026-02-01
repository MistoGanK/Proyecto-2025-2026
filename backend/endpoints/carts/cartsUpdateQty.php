<?php
session_start();
// Set header to indicate the response is JSON
header('Content-Type: application/json');

// Get and sanitize input
// Note: mysqli_real_escape_string should be used here if you were using POST, 
// but for GET parameters, htmlspecialchars provides basic protection.
$qty = htmlspecialchars($_GET['qty']);
$id_product = htmlspecialchars($_GET['id']);
$id_customer = $_SESSION['id_customer'];

// --- 1. Update Quantity Query ---
$queryUpdateQty = "
  UPDATE `022_shopping_cart`
  SET qty = $qty 
  WHERE
    id_product = $id_product
  AND 
    id_customer = $id_customer";

// --- 2. Query to get the new GLOBAL Subtotal ---
$querySubtotal = " 
  SELECT 
    SUM(qty * price) AS subtotal
  FROM `022_view_customers_shopping_cart`
  WHERE id_customer = $id_customer 
";

// --- 3. Query to get the new ITEM Subtotal ---
$queryNewItemSubtotal = "
    SELECT 
        (qty * price) AS item_subtotal
    FROM `022_view_customers_shopping_cart`
    WHERE id_customer = $id_customer AND id_product = $id_product
";

// Open connection
include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/config/connection.php');

$resultUpdateQty = mysqli_query($conn, $queryUpdateQty);

// Initialize response data
$response_data = [
    'global_subtotal' => 0.00,
    'item_subtotal' => 0.00,
    'error' => null
];

if (!$resultUpdateQty) {
    $response_data['error'] = "Error updating quantity: " . mysqli_error($conn);
}

// Execute Subtotal Global Query
$resultSubtotal = mysqli_query($conn, $querySubtotal);
if ($resultSubtotal && $row = mysqli_fetch_assoc($resultSubtotal)) {
    $response_data['global_subtotal'] = number_format($row['subtotal'], 2, '.', ''); 
} else {
    $response_data['error'] = "Error retrieving global subtotal: " . mysqli_error($conn);
}

// Execute Item Subtotal Query
$resultNewItemSubtotal = mysqli_query($conn, $queryNewItemSubtotal);
if ($resultNewItemSubtotal && $row = mysqli_fetch_assoc($resultNewItemSubtotal)) {
    $response_data['item_subtotal'] = number_format($row['item_subtotal'], 2, '.', '');
} else {
    // If the item was deleted
    $response_data['item_subtotal'] = number_format(0, 2, '.', '');
}

// Return the result as JSON
echo json_encode($response_data);

// Clean up
if (isset($resultSubtotal)) mysqli_free_result($resultSubtotal);
if (isset($resultNewItemSubtotal)) mysqli_free_result($resultNewItemSubtotal);
mysqli_close($conn);

?>