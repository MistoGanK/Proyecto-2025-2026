<!-- Header -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/header.php'); ?>

<h1>db_order_update</h1>
<p>You Updated: </p>
<?php
// Test
// print_r($_POST); // Debug 
$update_output = "order_id_order Not found";
// Check if POST its retrieved and if if has content 
if (!isset($_POST['order_id_order']) || empty($_POST['order_id_order'])) {
    $update_output = "ERROR: order_id_order is missing";
} else {
    // Open connection
    include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/config/connection.php');
    // Save the variables
    $order_id_order = mysqli_escape_string($conn, $_POST['order_id_order']);
    $order_id_customer = mysqli_escape_string($conn,$_POST['order_id_customer']);
    $order_id_product = mysqli_escape_string($conn,$_POST['order_id_product']);
    $order_id_payment_method = mysqli_escape_string($conn,$_POST['order_id_payment_method']);
    $order_qty = mysqli_escape_string($conn,$_POST['order_qty']);
    $oder_unit_price = mysqli_escape_string($conn,$_POST['oder_unit_price']);
    // $order_discount_rate = mysqli_escape_string($conn,$_POST['order_discount_rate']);
    $order_total = mysqli_escape_string($conn,$_POST['order_total']);
    $order_date = mysqli_escape_string($conn,$_POST['order_date']);
    $order_canceled = mysqli_escape_string($conn,$_POST['order_canceled']);

    $update_date;
    //Query
    $sql = 
    "UPDATE orders
    SET
        id_customer = $order_id_customer,
        id_product = $order_id_product,
        id_payment_method = '$order_id_payment_method',
        qty = $order_qty,
        unit_price = '$oder_unit_price',
        total = '$order_total',
        canceled = $order_canceled,
        order_updated_date = CURRENT_TIMESTAMP()
        
    WHERE id_order = $order_id_order
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