<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include(__DIR__ . '/../../config/connection.php');

$id = isset($_GET['id']) ? intval($_GET['id']) : null; // intval es más seguro para IDs numéricos

if (!$id) {
    echo json_encode(["error" => "Falta el ID del producto"]);
    exit;
}

try {
    // 1. Consulta de información general
    $queryProduct = "SELECT * FROM `022_products` WHERE id_product = $id LIMIT 1;";
    $resultProduct = mysqli_query($conn, $queryProduct);
    
    if ($resultProduct && mysqli_num_rows($resultProduct) > 0) {
        $product = mysqli_fetch_assoc($resultProduct);

        // 2. Consulta de imágenes relacionadas (SIN DUPLICAR DATOS)
        $queryMedia = "SELECT media_src FROM `022_product_media` WHERE id_product = $id;";
        $resultMedia = mysqli_query($conn, $queryMedia);
        
        $images = [];
        while ($row = mysqli_fetch_assoc($resultMedia)) {
            $images[] = $row['media_src'];
        }

        // 3. Anidamos las imágenes dentro del objeto producto
        $product['all_images'] = $images;

        echo json_encode($product);
    } else {
        echo json_encode(["error" => "Producto no encontrado"]);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["error" => "Error interno: " . $e->getMessage()]);
}

mysqli_close($conn);