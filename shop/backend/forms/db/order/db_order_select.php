<!-- Connection -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/config/connection.php'); ?>
<!-- Header -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/header.php'); ?>
<h1>db_order_select</h1>
<p>You Selected: </p>
<!-- Logical fragment -->
<?php 
print_r($_POST); // Debug 
// Get date
// $id_product = $_POST['id_product'];

// Put dat int the database 
    // // The save query on double quotos
    //  $sqlMdbInsert = "
    //     INSERT INTO products (....)
    //     (
    //         VALUES ('$id_product') // Always quotes for string '' 
    //     );"

// Send confirmation
?>
</form>
<!-- Footer -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/footer.php'); ?>
