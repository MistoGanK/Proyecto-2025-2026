<!-- Header -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/header.php'); ?>
<main class="bg-gray-400 ">
<!-- Logical fragment -->
<?php
// Debug 
// print_r($_POST); 
// Variables
$product_output = "No product selected or found";

// Before starting the query, check If the variable was sended and that the variabel is not empty

if (!isset($_POST['id_product']) || empty($_POST['id_product'])) {
    $id_product = null;
}
// Open connection
include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/config/connection.php');
// escape the string to avoid mysql injection
// $id_product = mysqli_real_escape_string($conn, $_POST['id_product']);
// Initialize variable that will save the designed query
$sql;
if ($id_product != null) {
    // Query
    $sql = "SELECT * FROM products WHERE id_product = '$id_product'";
} else {
    // Query
    $sql = "SELECT * FROM products;";
}
// Execute the query
$query_result = mysqli_query($conn, $sql);

// Check if the query exists and if there was rows affected
if ($query_result) {
    // Check if any row where returned
    if (mysqli_num_rows($query_result) > 0) {
        // Loop and return formatted result
        while ($row = mysqli_fetch_assoc($query_result)) {
            $id_product = $row['id_product'];
            // Format the output
            printf("<div class='products_contaner'>");
            printf("<p>" . "Product ID: " . $row['id_product'] . "</p>");
            printf("<p>" . "Product Name: " . $row['product_name'] . "</p>");
            printf("<p>" . "Product Price: " . $row['price'] . "€" . "</p>");
            printf("<p>" . "Product Stock: " . $row['stock'] . "</p>");
            printf("<p>" . "Product Description: " . $row['description'] . "</p>");
            printf("<p>" . "Product inserted_date: " . $row['inserted_date'] . "</p>");
            printf("<p>" . "Product updated date: " . $row['updated_date'] . "</p>");
            printf("<p>" . "Product launch date: " . $row['launch_date'] . "</p>");
            printf("<p>" . "Product availability: " . $row['availability'] . "</p>");
            printf("<p>" . "Product active: " . $row['active'] . "</p>");
            // INCLUDE THIS CODE ON GENERAL PAGE
            printf("<div class='bg-gray-500 text-gray-100'>");
                include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/forms/products/form_product_delete_call.php');
                include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/forms/products/form_product_select.php');
                include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/forms/products/form_product_update_call.php');
            printf("</div>");
            printf("</div>");
        }
    } else {
        $product_output = "Product with ID $id_product not found.";
    }
} else {
    // Error on query execution
    $product_output = "Database Error: " . mysqli_error($conn);
}

// Free the result
mysqli_free_result($query_result);
// Close connection
mysqli_close($conn);
?>
<?php

?>
</main>
<!-- Footer -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/footer.php'); ?>

