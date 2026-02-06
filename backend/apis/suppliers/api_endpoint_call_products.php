<?php
// Connection
include(__DIR__ . '/../../config/connection.php');

// Get all suppliers
$sqlSuppliers = "SELECT * FROM `022_view_suppliers_endpoints`";
$result = mysqli_query($conn, $sqlSuppliers);
$suppliers = mysqli_fetch_all($result, MYSQLI_ASSOC);

foreach ($suppliers as $supplier) {
  print_r($supplier['api_endpoint_products']);

  $supplierUrl = $supplier['api_endpoint_products'];
  $apiKey = $supplier['api_key'];
  $idSupplier = $supplier['id_supplier'];

  $uCurlUrl = $supplierUrl . urlencode($apiKey);

  $ch = curl_init();

  $headers = array(
    "Content-Type: application/json"
  );

  // Configuración de cURL
  curl_setopt($ch, CURLOPT_URL, $uCurlUrl);

  // Pasamos los headers correctamente 
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_HTTPGET, true);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch, CURLOPT_TIMEOUT, 30);
  curl_setopt($ch, CURLOPT_VERBOSE, true);

  // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

  // Ejecución
  $result = curl_exec($ch);

  if (curl_errno($ch)) {
    echo 'Error en cURL: ' . curl_error($ch);
  } else {
    // Save the result
    $data = json_decode($result, true);
    if (!is_array($data)) {
      // Server Response
      echo "<pre>";
      var_dump($result);
      echo "</pre>";
      exit;
    }

    // Clean firts all the products from the supplier
    $sqlClean = "DELETE FROM `022_products` WHERE id_supplier = $idSupplier";
    $resultClean = mysqli_query($conn, $sqlClean);

    foreach ($data as $product) {
      // Save the rows

      $supplier_product_code = $product['product_id'];
      $product_name = $product['product_name'];
      $product_src_img = $product['product_image'];
      $product_price = $product['product_price'];
      $product_stock = $product['product_stock'];

      // Insert into the table `022_products'
      $sql = "INSERT INTO `022_products` (supplier_product_code,product_name,img_src,price,stock,id_supplier)
    VALUES ('$supplier_product_code','$product_name','$product_src_img','$product_price','$product_stock',$idSupplier)
    ON DUPLICATE KEY UPDATE
      stock = $product_stock
    ";
      if (mysqli_query($conn, $sql)) {
      } else {
        echo "Error on product ID $product_id_supplier: " . mysqli_error($conn) . "<br>";
      }
    }
  }
}
curl_close($ch);
// $apiKey = '12345niki';
// $idSupplier = 1;

// $uCurlUrl = "https://remotehost.es/student014/shop/backend/endpoints/product_seller.php?apikey=" . urlencode($apiKey);

// $ch = curl_init();

// $headers = array(
//   "Content-Type: application/json"
// );

// // Configuración de cURL
// curl_setopt($ch, CURLOPT_URL, $uCurlUrl);

// // Pasamos los headers correctamente 
// curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// curl_setopt($ch, CURLOPT_HTTPGET, true);
// curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
// curl_setopt($ch, CURLOPT_TIMEOUT, 30);
// curl_setopt($ch, CURLOPT_VERBOSE, true);

// // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

// // Ejecución
// $result = curl_exec($ch);

// if (curl_errno($ch)) {
//   echo 'Error en cURL: ' . curl_error($ch);
// } else {
//   // Save the result
//   $data = json_decode($result, true);
//   if (!is_array($data)) {
//     // Server Response
//     echo "<pre>";
//     var_dump($result);
//     echo "</pre>";
//     exit;
//   }

//   foreach ($data as $product) {
//     // Save the rows

//     $supplier_product_code = $product['product_id'];
//     $product_name = $product['product_name'];
//     $product_src_img = $product['product_image'];
//     $product_price = $product['product_price'];
//     $product_stock = $product['product_stock'];

//     // print_r($product);
//     // Insert into the table `022_products'
//     $sql = "INSERT INTO `022_products` (supplier_product_code,product_name,img_src,price,stock,id_supplier)
//     VALUES ('$supplier_product_code','$product_name','$product_src_img','$product_price','$product_stock',$idSupplier)
//     ON DUPLICATE KEY UPDATE
//       stock = $product_stock
//     ";
//     if (mysqli_query($conn, $sql)) {
//     } else {
//       echo "Error on product ID $product_id_supplier: " . mysqli_error($conn) . "<br>";
//     }
//   }
// }

// curl_close($ch);
