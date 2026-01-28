<?php 
session_start();

  $productName = htmlspecialchars($_GET['productName']) ?? '';
  $query = "
      SELECT * 
      FROM `022_products`
      WHERE 
        product_name LIKE '%$productName%';
    ";
    include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/config/connection.php'); 
    $result = mysqli_query($conn,$query);
    // $products = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Include the function showProducts()
    include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/functions/products/showProducts.php');
    showProducts($result);

    // $products_json = json_encode($products);
    // echo $products_json;
    mysqli_close($conn);
    ?>