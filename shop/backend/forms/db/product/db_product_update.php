<!-- Connection -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/config/connection.php'); ?>

<!-- Header -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/header.php'); ?>

<h1>db_product_update</h1>
<p>You updated: </p>
<?php 
// Test
use Dom\Mysql;

print_r($_POST); // Debug 
// Get date
// $product_name = $_POST['id_product'];

// GO TO db_products_update 2 ASK FOR PRODUCT_ID 15

// Save all POST on VARIABLES and INSERT IT INTO THE DB

// SHOW 

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