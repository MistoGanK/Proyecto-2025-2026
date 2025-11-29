<?php
session_start();
$qty = htmlspecialchars($_GET['qty']);
$id_product = htmlspecialchars($_GET['id']);
$id_customer = $_SESSION['id_customer'];

$queryUpdateQty = "
  UPDATE `022_shopping_cart`
  SET qty = $qty 
  WHERE
    id_product = $id_product
  AND 
    id_customer = $id_customer";

$querySubtotal = " 
  SELECT 
    SUM(qty * price) AS subtotal
  FROM `022_view_customers_shopping_cart`
  WHERE id_customer = $id_customer 
";

// Open connection
include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/config/connection.php');
$resultUpdateQty = mysqli_query($conn, $queryUpdateQty);
$resultSubtotal = mysqli_query($conn, $querySubtotal);

$subtotal = 0;

if($resultUpdateQty){

}else{
  echo "Error al qtyUpdatCart: " . mysqli_error($conn);
}

if ($resultSubtotal) {
    while ($row = mysqli_fetch_assoc($resultSubtotal)) {
        $subtotal += $row['subtotal'];
    };
} else {
    $resultSubtotal = "Error al obtener subtotal: " . mysqli_error($conn); 
}

// Return the subtotal
echo $subtotal;

mysqli_close($conn);
mysqli_free_result($resultSubtotal);

?>