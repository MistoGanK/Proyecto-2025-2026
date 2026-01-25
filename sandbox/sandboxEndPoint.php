<?php 
  $jsonGet = file_get_contents('php://input');
  $data = json_decode($jsonGet,true);
  
  // Validation
  if (!$data){
    http_response_code(400);
    echo json_encode(["error" => "Invalid Data"]);
    exit;
  }

  $weatherInfo = $data['apiResult'] ?? null;

  if($weatherInfo){
    // Saved on a file AND into a table 

    $time = date("c",time());
    $routeFile = $_SERVER['DOCUMENT_ROOT'] . '/student022/backend/logs/weatherLogs.txt';
    $file = fopen($routeFile, "a+");
    $txt = json_encode($weatherInfo, JSON_PRETTY_PRINT);
    fwrite($file,$txt);
    fclose($file);

    // Save the JSON to table $txt -> Last Update

    // Connection
    include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/config/connection.php');

    $scapedJson = mysqli_real_escape_string($conn, $txt);
    $sql = "INSERT INTO `022_weather_api` (json_weather) VALUES ('$scapedJson')";
    
    if(mysqli_query($conn,$sql)){

    }else{

    }

    exit();
  }else{
    echo 'JSON structure not recognized';
  }


?>