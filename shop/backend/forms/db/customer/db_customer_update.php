<!-- Connection -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/config/connection.php'); ?>
<!-- Header -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/header.php'); ?>

<h1>db_customer_update</h1>
<p>You updated: </p>
<?php 
// Test
use Dom\Mysql;

print_r($_POST); // Debug 
// Get date
// $product_name = $_POST['id_product'];

// Put dat int the database 
    // The save query on double quotos
    /* $sqlMdbInsert = "
        INSERT INTO prodcuts (....)
        (
            VALUES ('$product_name') // Always quotes for string '' 
        );"
    */
// Send confirmation
?>

<!-- Footer -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/footer.php'); ?>