<?php
// ENDPOINT for Rotation Section
// Cabecera de seguridad
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$query = 'SELECT * FROM `022_products` WHERE id_product IN (75,77);';

// Open connection 
include(__DIR__ . '/../../config/connection.php');
//  Fetch and json encode the result, try carch for error response on JavaScript
try {
  if ($result = mysqli_query($conn, $query)) {
    $getFetch = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $jsonGet = json_encode($getFetch);
    echo  $jsonGet;
  } else {
    http_response_code(500);
    echo json_encode(["error" => "Error en la consulta a la base de datos"]);
  }
} catch (Exception $e) {
  http_response_code(500);
  echo json_encode(["error" => "Error de conexión en el servidor"]);
}
// Closing conexion
if (isset($conn)) {
  mysqli_close($conn);
}