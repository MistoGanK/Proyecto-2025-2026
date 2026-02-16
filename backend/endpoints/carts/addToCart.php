<?php
session_start();
header('Content-Type: application/json');
include(__DIR__ . '/../../config/connection.php'); // Asumo que aquí tienes $conn = mysqli_connect(...)

$id_product = isset($_POST['id_product']) ? intval($_POST['id_product']) : null;
$qty = isset($_POST['qty']) ? intval($_POST['qty']) : 1;

if (!$id_product) {
    echo json_encode(['success' => false, 'error' => 'No product ID']);
    exit;
}

if (isset($_SESSION['id_customer'])) {
    $id_customer = $_SESSION['id_customer'];

    // 1. Verificar si ya existe el producto en el carrito
    $sql_check = "SELECT qty FROM `022_shopping_cart` WHERE id_customer = ? AND id_product = ?";
    $stmt_check = mysqli_prepare($conn, $sql_check);
    mysqli_stmt_bind_param($stmt_check, "ii", $id_customer, $id_product);
    mysqli_stmt_execute($stmt_check);
    $result_check = mysqli_stmt_get_result($stmt_check);

    if ($row = mysqli_fetch_assoc($result_check)) {
        // 2. Si existe, UPDATE
        $sql_update = "UPDATE `022_shopping_cart` SET qty = qty + ? WHERE id_customer = ? AND id_product = ?";
        $stmt_update = mysqli_prepare($conn, $sql_update);
        mysqli_stmt_bind_param($stmt_update, "iii", $qty, $id_customer, $id_product);
        mysqli_stmt_execute($stmt_update);
    } else {
        // 3. Si no existe, INSERT
        $sql_insert = "INSERT INTO `022_shopping_cart` (id_customer, id_product, qty) VALUES (?, ?, ?)";
        $stmt_insert = mysqli_prepare($conn, $sql_insert);
        mysqli_stmt_bind_param($stmt_insert, "iii", $id_customer, $id_product, $qty);
        mysqli_stmt_execute($stmt_insert);
    }
    echo json_encode(['success' => true, 'method' => 'database']);
} else {
    // Lógica de Cookies (igual que antes, no requiere SQL directo)
    $cart = isset($_COOKIE['shopping_cart']) ? json_decode($_COOKIE['shopping_cart'], true) : [];
    $cart[$id_product] = isset($cart[$id_product]) ? $cart[$id_product] + $qty : $qty;
    setcookie('shopping_cart', json_encode($cart), time() + (86400 * 30), "/");
    echo json_encode(['success' => true, 'method' => 'cookie']);
}