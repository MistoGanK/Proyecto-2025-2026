<?php
header('Content-Type: application/json');
// Open connection
include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/config/connection.php');
// Query
$sql = "SELECT `orders_year`,`orders_month`, `total_order_income` FROM `total_order_income_current_year`";
$result = mysqli_query($conn,$sql);
$sales = mysqli_fetch_all($result,MYSQLI_ASSOC);
$data = [];
foreach ($sales as $sale){
  $data[$sale['orders_month']] = $sale['total_order_income'];
}
$response = json_encode($data);
echo $response;

exit;
?>