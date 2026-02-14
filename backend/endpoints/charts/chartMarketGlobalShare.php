<?php
header('Content-Type: application/json');
include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/config/connection.php');

$sql = "SELECT `country`, `total_income`, `market_share_percent` FROM `022_regional_sales_&_revenue` LIMIT 10";
$result = mysqli_query($conn, $sql);
$marketShare = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo json_encode($marketShare);
exit;
?>