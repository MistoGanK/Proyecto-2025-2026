<?php 
session_start();

  $orderCode = htmlspecialchars($_GET['orderCode']) ?? '';
  $query = "
      SELECT * 
      FROM `022_view_orders`
      WHERE 
        id_order LIKE '%$orderCode%'
      ORDER BY id_order ASC
      LIMIT 10;
    ";
    
    include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/config/connection.php'); 
    $result = mysqli_query($conn,$query);
    // $products = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Include the function showProducts()
    include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/functions/orders/showOrders.php');
    showOrders($result,$conn);

    // $products_json = json_encode($products);
    // echo $products_json;
    mysqli_close($conn);
    ?>