<!-- Header -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/header.php'); ?>
<h1>db_product_select</h1>
<p>You selected: </p>

<!-- Logical fragment -->
<?php 
// Debug 
print_r($_POST); 
// Variables
$product_output = "No product selected or found";

// Before starting the query, check If the variable was sended and that the variabel is not empty

if (!isset($_POST['id_product']) || empty($_POST['id_product'])){
    $product_output = "Error: Product ID is missing";
}else{
    // Open connection
    include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/config/connection.php');
    // escape the string to avoid mysql injection
    $id_product = mysqli_real_escape_string($conn, $_POST['id_product']);

    // Query
    $sql = "SELECT * FROM products WHERE id_product = '$id_product'";

    // Execute the query
    $query_result = mysqli_query($conn,$sql);

    // Check if the query exists and if there was rows affected
    if ($query_result){
        // Check if any row where returned
        if (mysqli_num_rows($query_result)>0){
            // Loop and return formatted result
            while ($row = mysqli_fetch_assoc($query_result)){
                // Format the output
                printf("<p>"."Product ID: ".$row['id_product']."<p>");
                printf("<p>"."Product Name: ".$row['product_name']."<p>");
                printf("<p>"."Product Price: ".$row['price']."€"."<p>");
            }
        }else{
            $product_output = "Product with ID $id_product not found.";
        }
    }else{
        // Error on query execution
        $product_output = "Database Error: " . mysqli_error($conn);
    }
    // Free the result
    mysqli_free_result($query_result);
    // Close connection
    mysqli_close($conn);
}
?>
<!-- Footer -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/footer.php'); ?>
