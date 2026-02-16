<!-- Logical fragment -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/header.php'); ?>
<?php
$product_output = "No product selected or found";

// Before starting the query, check If the variable was sended and that the variabel is not empty
if (!isset($_POST['id_product']) || empty($_POST['id_product'])) {
    $id_product = null;
}
  // Get function showProducts()
    include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/functions/products/showProducts.php');
    showProducts($products);

?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/footer.php'); ?>