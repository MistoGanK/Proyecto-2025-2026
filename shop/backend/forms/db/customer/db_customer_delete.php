<!-- Header -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/header.php'); ?>

<h1>db_customer_delete</h1>
<?php
// Test
// print_r($_POST); // Debug 
$delete_output = "id_customer Not found";
// Check if POST its retrieved and if if has content 
if (!isset($_POST['id_customer']) || empty($_POST['id_customer'])) {
    $delete_output = "ERROR: id_customer is missing";
} else {
    // Open connection
    include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/config/connection.php');
    $id_customer = mysqli_escape_string($conn, $_POST['id_customer']);

    //Query
    $sql = "DELETE FROM customers WHERE id_customer = '$id_customer';";

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
<p>You deleted the customer with the ID: <?php echo $id_customer?></p>

<!-- Footer -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/shop/backend/footer.php'); ?>