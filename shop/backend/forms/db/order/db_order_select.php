<!-- Header -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/header.php'); ?>
<h1>db_order_select</h1>
<p>You selected: </p>

<!-- Logical fragment -->
<?php 
// Debug 
// print_r($_POST); 
// Variables
$product_output = "No order selected or found";

// Before starting the query, check If the variable was sended and that the variabel is not empty

if (!isset($_POST['order_id_order']) || empty($_POST['order_id_order'])){
    $order_id_order = null;
}
    // Open connection
    include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/config/connection.php');
    // escape the string to avoid mysql injection
    $order_id_order = mysqli_real_escape_string($conn, $_POST['order_id_order']);
    // Initialize variable that will save the designed query
    $sql;
    if ($order_id_order!=null){
        // Query
        $sql = "SELECT * FROM orders WHERE id_order = '$order_id_order'";
    }else{
        // Query
        $sql = "SELECT * FROM orders;";
    }
    // Execute the query
    $query_result = mysqli_query($conn,$sql);

    // Check if the query exists and if there was rows affected
    if ($query_result){
        // Check if any row where returned
        if (mysqli_num_rows($query_result)>0){
            // Loop and return formatted result
            while ($row = mysqli_fetch_assoc($query_result)){
                // Format the output
                printf("<p>"."Order ID: ".$row['id_order']."<p>");
                printf("<p>"."Order Customer ID: ".$row['id_customer']."<p>");
                printf("<p>"."Order Product ID: ".$row['id_product']."<p>");
                printf("<p>"."Order Payment Method ID: ".$row['id_payment_method']."<p>");
                printf("<p>"."Order qty: ".$row['qty']."</p>");
                printf("<p>"."Order unit price: ".$row['unit_price']."€"."</p>");
                printf("<p>"."Order Discount: ".$row['discount']."</p>");
                printf("<p>"."Order Total: ".$row['total']."€"."</p>");
                printf("<p>"."Order Date: ".$row['order_date']."</p>");
                printf("<p>"."Order is canceled: ".$row['canceled']."</p>");
            }
        }else{
            $product_output = "Order with ID $order_id_order not found.";
        }
    }else{
        // Error on query execution
        $product_output = "Database Error: " . mysqli_error($conn);
    }
    // Free the result
    mysqli_free_result($query_result);
    // Close connection
    mysqli_close($conn);
?>
<!-- Footer -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/student022/shop/backend/footer.php'); ?>
