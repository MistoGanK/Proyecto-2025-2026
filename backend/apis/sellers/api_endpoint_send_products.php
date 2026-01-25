<?php
header("Content-Type: application/json");
// Yo recibo la solucitud + apiKey
// apiKeySend
// Try to read from header POST
print_r($_POST);   
$key = $_POST['apiKey'];
echo "Api key: $key";

// Query ApiKey (Test)
$sqlApi =
"SELECT api_key 
FROM `022_vendors_api_keys`
WHERE api_key = '$key';";
// WHERE api_key = '$apiKey';";

// Query Products (TEST)
$sql = 'SELECT * FROM `022_products` LIMIT 5;';

// connection
include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/config/connection.php');

// Firts check if apiKey retrieved is correct
$resultApiCheck = mysqli_query($conn, $sqlApi);

if (mysqli_num_rows($resultApiCheck) > 0) {
  $products = mysqli_query($conn, $sql);
  $assocProducts = mysqli_fetch_all($products, MYSQLI_ASSOC);
  $jsonProducts = json_encode($assocProducts);

  echo $jsonProducts;
}else{
  echo 'Wrong apikey';
}

?>
