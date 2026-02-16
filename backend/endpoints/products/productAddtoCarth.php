<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/config/connection.php');

$id_customer = mysqli_real_escape_string($conn, $_SESSION['id_customer']) ?? null;
$id_product = htmlspecialchars($_GET['product_id']) ?? '';
$query = "
      INSERT INTO `022_shopping_cart`(id_customer,id_product,qty)
      VALUES ($id_customer,$id_customer,1)
      ON DUPLICATE KEY UPDATE qty += 1
    ;";

$result = mysqli_query($conn, $query);

mysqli_close($conn);
