<?php
// ENDPOINT for ABOUT SECTION
// Cabecera de seguridad
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$queryGetAbout = 'SELECT * FROM `022_about`;';

// Open connection 
include(__DIR__ . '/../../config/connection.php');
//  Fetch and json encode the result, try carch for error response on JavaScript
try {
  if ($resultGetAbout = mysqli_query($conn, $queryGetAbout)) {
    $getAboutFetch = mysqli_fetch_all($resultGetAbout, MYSQLI_ASSOC);
    $jsonGetAbout = json_encode($getAboutFetch);
    echo  $jsonGetAbout;
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