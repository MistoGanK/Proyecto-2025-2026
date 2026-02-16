<?php
header('Content-Type: application/json');
// Open connection
include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/config/connection.php');
// Query
$sql = "SELECT * FROM total_order_income_current_year";
$result = mysqli_query($conn,$sql);
$response = json_encode(mysqli_fetch_all($result,MYSQLI_ASSOC));
echo $response;

exit;
?>