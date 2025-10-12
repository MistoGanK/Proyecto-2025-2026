<!-- Connection -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/config/connection.php'); ?>
<!-- Header -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/header.php'); ?>

<h1>db_product_delete</h1>
<?php
// Test
// print_r($_POST); // Debug 
$delete_output = "id_product Not found";
// Check if POST its retrieved and if if has content 
if (!isset($_POST['id_product']) || empty($_POST['id_product'])) {
    $delete_output = "ERROR: id_product is missing";
} else {
    // Open connection
    include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/config/connection.php');
    $id_product = mysqli_escape_string($conn, $_POST['id_product']);

    //Query
    $sql = "DELETE FROM products WHERE id_product = '$id_product';";

    // Save the query 
    $query_result = mysqli_query($conn, $sql);
    if ($query_result) {
        $delete_output = "Record Successfully deleted";
    } else {
        // Error from connection
        $delete_output = "Database Error:" . mysqli_error($conn);
    }
    // Show the result
    printf("<p>" . $delete_output . "</p>");
    // Close the connection
    mysqli_close($conn);
}

?>
<p>You deleted the product with the ID: <?php echo $id_product?></p>

<!-- Footer -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/footer.php'); ?>