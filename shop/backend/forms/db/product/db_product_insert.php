<!-- Header -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/header.php'); ?>

<!-- HTML -->
<h1>db_product_insert</h1>
<p>You Inserted: </p>

<?php
// Test
print_r($_POST); // Debug 

// Variables
$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];
$product_qty = $_POST['product_qty'];
$product_description = $_POST['product_description'];

// SQL INSERT 

$sql = "
INSERT INTO products (product_name,price,stock,description)
VALUES ('$product_name','$product_price','$product_qty','$product_description')
;";

// Connection 
include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/config/connection.php');

//mysqli_query
if (mysqli_query($conn, $sql)) {
    echo "<p>Producto insertado con extio:</p>";
    echo
    "<ul>
    <li>Nombre: $product_name</li>
    <li>Precio: $product_price</li>
    <li>Cantdiad: $product_qty</li>
    <li>Descripción: $product_description</li> 
</ul>";
} else {
    echo "<p>Error al insertar el producto: " . mysqli_error($conn) . "</p>";
}

// Send confirmation
?>

<!-- Footer -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/footer.php'); ?>