<?php
// backend/endpoints/suppliers/supplierEndpoint.php?id_supplier=2;
// backend/endpoints/suppliers/supplierEndpoint.php?id_supplier=3;
// backend/endpoints/suppliers/supplierEndpoint.php?id_supplier=4;

// $id_supplier = $_GET["id_supplier"];
$id_supplier = 2;

$sql = "SELECT * FROM `022_suppliers` WHERE apyKey = $api_key";

$result = mysqli_query($conn, $sql);
$supplier = mysqli_fetch_assoc($result);

if(!empty($supplier)):
$url = $supplier['api_endpoint_products'];

$products_json = file_get_contents($url);
$products = json_decode($products_json, true);

// Delete preveius products of the supplier and update
$sql = "DELETE FROM `022_products` WHERE id_supplier = 2";

// Loop and insert
foreach ($products as $product) {
  // JsonField variables From supplier (On Going)
  $id_supplier = $product['id_supplier'];
  $supplier_product_code = $product['supplier_product_code'];
  $product_name = $product['product_name'];
  $price = $product['price'];
  $stock = $product['stock'];
  $description = $product['description'];
  $img_src = $product['img_src'];

  $sql = "INSERT INTO `022_products` (id_supplier,supplier_product_code,product_name,price,stock,`description`,img_src)
  VALUES (
    $id_supplier,
    '$supplier_product_code',
    '$product_name',
    $price,
    $stock,
    '$description',
    '$img_src'
  )";
  mysqli_query($conn, $sql);
}
?>