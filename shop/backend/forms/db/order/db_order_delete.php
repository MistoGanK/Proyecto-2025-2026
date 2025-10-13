<!-- Header -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/header.php'); ?>

<h1>db_order_delete</h1>
<?php
// Test
// print_r($_POST); // Debug 
$delete_output = "order_id_order Not found";
// Check if POST its retrieved and if if has content 
if (!isset($_POST['order_id_order']) || empty($_POST['order_id_order'])) {
    $delete_output = "ERROR: order_id_order is missing";
} else {
    // Open connection
    include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/config/connection.php');
    $order_id_order = mysqli_escape_string($conn, $_POST['order_id_order']);

    //Query
    $sql = "DELETE FROM products WHERE id_order = '$order_id_order';";

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
<p>You deleted the Order with the ID: <?php echo $order_id_order?></p>

<!-- Footer -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/footer.php'); ?>