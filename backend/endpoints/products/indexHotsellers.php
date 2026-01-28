<?php 
session_start();

  $productName = htmlspecialchars($_GET['productName']) ?? '';
  $query = "
      SELECT * 
      FROM `022_products`
      WHERE id_product = 1";
    // Open connection
    include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/config/connection.php'); 
    // Query the result
    $result = mysqli_query($conn,$query);
    // Fetch the result
    $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // JSON the fetch
    $products_json = json_encode($result,JSON_PRETTY_PRINT);
    // Pass the json fetch
    return $products_json;
    mysqli_close($conn);
    
    ?>