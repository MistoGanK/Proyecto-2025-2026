<!-- Header -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/header.php'); ?>
<h1>db_product_select</h1>
<p>You selected: </p>

<!-- Logical fragment -->
<?php 
// Debug 
print_r($_POST); 
// Variables
$id_product = $_POST['id_product'];

// Query
$sql = "
SELECT * FROM products WHERE id_product = $id_product;
";

// Connection 
include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/config/connection.php');
//msqli_query
if (mysqli_query($conn,$sql)){

    $result = mysqli_fetch_assoc(mysqli_query($conn,$sql));
    foreach ($result as $product){
        echo "<p>$result.['id_product']</p>";
    };
}else{
     echo "<p>Error al insertar el producto: " . mysqli_error($conn) . "</p>";
}
?>
<!-- Footer -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/footer.php'); ?>
