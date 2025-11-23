<?php 
  $qty = htmlspecialchars($_GET['qty']);
  $id = htmlspecialchars($_GET['id']);

  $query = "
  UPDATE `022_products`
  SET stock = $qty 
  WHERE id_product = $id ";

  include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/config/connection.php'); 
  $result = mysqli_query($conn,$query);

  mysqli_close($conn);
?> 