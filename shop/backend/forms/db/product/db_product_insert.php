<!-- Header -->
<?php // include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/header.php'); ?>

<!-- HTML -->
<h1>db_product_insert</h1>
<p>You Inserted: </p>

<?php
// Test
//print_r($_POST); // Debug 

// Variables
$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];
$product_stock = $_POST['product_stock'];
$product_description = $_POST['product_description']; 
$product_launch_date = $_POST['product_launch_date'];
$product_availability = $_POST['product_availability'];
$product_active = $_POST['product_active'];

// Save the key on an associative array

$product_variables = [
    'product_name' => $product_name,
    'product_price' => $product_price,
    'product_stock' => $product_stock,
    'product_description' => $product_description,
    'product_launch_date' => $product_launch_date,
    'product_availability' => $product_availability,
    'product_active' => $product_active
];

// SQL INSERT 

$sql = "
INSERT INTO products (product_name,price,stock,description,launch_date,availability,active)
VALUES ('$product_name','$product_price','$product_stock','$product_description','$product_launch_date','$product_availability','$product_active')
;";

// Connection 
include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/config/connection.php');

//mysqli_query
if (mysqli_query($conn, $sql)) {
    echo "<p>Producto insertado con extio:</p>";
    echo
    "<ul>
    <li>Name: $product_name</li>
    <li>Price: $product_price</li>
    <li>Quantity: $product_stock</li>
    <li>Description: $product_description</li> 
    <li>Launch Date: $product_launch_date</li> 
    <li>Availability: $product_availability</li> 
    <li>Active: $product_active</li> 
</ul>";
} else {
    echo "<p>Error al insertar el producto: " . mysqli_error($conn) . "</p>";
}

// Send confirmation
?>

<!-- Footer -->
<?php // include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/footer.php'); ?>