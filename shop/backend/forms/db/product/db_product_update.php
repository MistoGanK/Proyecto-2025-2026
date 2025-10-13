<!-- Header -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/header.php'); ?>

<h1>db_product_update</h1>
<p>You Updated: </p>
<?php
// Test
// print_r($_POST); // Debug 
$update_output = "id_product Not found";
// Check if POST its retrieved and if if has content 
if (!isset($_POST['id_product']) || empty($_POST['id_product'])) {
    $update_output = "ERROR: id_product is missing";
} else {
    // Open connection
    include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/config/connection.php');
    // Save the variables
    $id_product = mysqli_escape_string($conn, $_POST['id_product']);
    $product_name = mysqli_escape_string($conn,$_POST['product_name']);
    $product_price = mysqli_escape_string($conn,$_POST['product_price']);
    $product_stock = mysqli_escape_string($conn,$_POST['product_stock']);
    $product_description = mysqli_escape_string($conn,$_POST['product_description']);
    $product_launch_date = mysqli_escape_string($conn,$_POST['product_launch_date']);
    $product_availability = mysqli_escape_string($conn,$_POST['product_availability']);
    $product_active = mysqli_escape_string($conn,$_POST['product_active']);
    
    $update_date;
    //Query
    $sql = 
    "UPDATE products
    SET
        product_name = '$product_name',
        price = $product_price,
        stock = $product_stock,
        description = '$product_description',
        updated_date = CURRENT_TIMESTAMP(),
        launch_date = '$product_launch_date',
        availability = '$product_availability',
        active = $product_active
        
    WHERE id_product = $id_product
    ;";

    // Save the query 
    $query_result = mysqli_query($conn, $sql);
    if ($query_result) {
        $update_output = "Records Successfully updated";
    } else {
        // Error from connection
        $update_output = "Database Error:" . mysqli_error($conn);
    }
    // Show the result
    printf("<p>" . $update_output . "</p>");
    // Close the connection
    mysqli_close($conn);
}

?>

<!-- Footer -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/footer.php'); ?>