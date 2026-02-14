<?php
header('Content-Type: application/json');

include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/config/connection.php');

$sql = "SELECT `country`, `total_income` FROM `022_regional_sales` ORDER BY `total_income` DESC";

$result = mysqli_query($conn, $sql);

if (!$result) {
  echo json_encode(["error" => mysqli_error($conn)]);
  exit;
}

$regionalSales = mysqli_fetch_all($result, MYSQLI_ASSOC);

$data = [];

foreach ($regionalSales as $row) {
  $data[] = [
    "country" => $row['country'],
    "total_income" => (float)$row['total_income']
  ];
}

echo json_encode($data);

mysqli_close($conn);
exit;
