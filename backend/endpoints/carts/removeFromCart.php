<?php
session_start();
header('Content-Type: application/json');
include(__DIR__ . '/../../config/connection.php');

$id_product = isset($_POST['id_product']) ? intval($_POST['id_product']) : null;

if (!$id_product) {
    echo json_encode(['success' => false, 'error' => 'No product ID']);
    exit;
}

// Logged User
if (isset($_SESSION['id_customer'])) {
    $id_customer = $_SESSION['id_customer'];

    $sql = "DELETE FROM `022_shopping_cart` WHERE id_customer = ? AND id_product = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $id_customer, $id_product);
    
    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => mysqli_error($conn)]);
    }
} 
// Guest user
else {
    $cart = isset($_COOKIE['shopping_cart']) ? json_decode($_COOKIE['shopping_cart'], true) : [];
    
    if (isset($cart[$id_product])) {
        unset($cart[$id_product]);
    }

    // Update cookies with the new array
    if (empty($cart)) {
        setcookie('shopping_cart', '', time() - 3600, "/"); // Borrar cookie
    } else {
        setcookie('shopping_cart', json_encode($cart), time() + (86400 * 30), "/");
    }
    
    echo json_encode(['success' => true]);
}